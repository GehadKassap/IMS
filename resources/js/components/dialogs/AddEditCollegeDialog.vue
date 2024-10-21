<script setup>
import { VForm } from 'vuetify/components/VForm'
import ErrorMessages from "@/components/ErrorMessages.vue";

import { useForm } from "@inertiajs/vue3";


const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  college: Object,
})

const emit = defineEmits([
  'update:isDialogVisible', 'actionReturn'
])

const form = useForm({
    name_en: "",
    name_ku: "",
    name_ar: "",
    code: "",
});

const submit = () => {
    if(props.college){
        form.put('colleges/'+props.college.id, {
            onSuccess: () => {
                emit('update:isDialogVisible', false)
                emit('actionReturn')
            },
        });
    }else {
        form.post('colleges', {
            onSuccess: () => {
                form.reset()
                emit('update:isDialogVisible', false)
            },
        });
    }
    
};


const onReset = () => {
    form.reset()
    emit('update:isDialogVisible', false)
    emit('actionReturn')
}

watch(props, () => {
  if(props.college){
    form.name_en = props.college.name.en
    form.name_ku = props.college.name.ku
    form.name_ar = props.college.name.ar
    form.code = props.college.code
  }
  else {
    form.name_en = ''
    form.name_ku = ''
    form.name_ar = ''
    form.code = ''
  }
})

</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 600"
    :model-value="props.isDialogVisible"
    @update:model-value="onReset"
  >
    <DialogCloseBtn @click="onReset" />

    <VCard class="pa-sm-4 pa-5">
      <VCardItem class="pa-0">
        <VCardTitle class="pa-0 ma-0 text-h4 mb-2 mt-2">
          {{ props.college ? 'Edit' : 'Add New' }} College
        </VCardTitle>
      </VCardItem>
      <VCardText>
          <ErrorMessages :errors="form.errors" />
          <VForm @submit.prevent="submit">
            <VRow>
              <VCol cols="12">
                <AppTextField
                  v-model="form.name_en"
                  autofocus
                  label="Name - English"
                  type="text"
                />
              </VCol>

              <VCol cols="12">
                <AppTextField
                  v-model="form.name_ku"
                  label="Name - Kurdish"
                  type="text"
                />
              </VCol>

              <VCol cols="12">
                <AppTextField
                  v-model="form.name_ar"
                  label="Name - Arabic"
                  type="text"
                />
              </VCol>

              <VCol cols="12">
                <AppTextField
                  v-model="form.code"
                  label="College Code"
                  type="text"
                />
              </VCol>
              
              <VCol cols="12">
                <VBtn
                  block
                  type="submit"
                  :loading="form.processing"
                >
                  Save
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
    </VCard>
  </VDialog>
</template>
