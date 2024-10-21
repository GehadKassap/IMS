<script setup>
import { VForm } from 'vuetify/components/VForm'
import ErrorMessages from "@/components/ErrorMessages.vue";

import { useForm } from "@inertiajs/vue3";


const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  department: Object,
  colleges: Array,
})

const emit = defineEmits([
  'update:isDialogVisible', 'actionReturn'
])

const form = useForm({
    name_en: "",
    name_ku: "",
    name_ar: "",
    code: "",
    college_id: "",
    study_system: "",
    stages: "",
    ects_count: "",
});

const submit = () => {
    if(props.department){
        form.put('departments/'+props.department.id, {
            onSuccess: () => {
                emit('update:isDialogVisible', false)
                emit('actionReturn')
            },
        });
    }else {
        form.post('departments', {
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
  if(props.department){
    form.name_en = props.department.name.en
    form.name_ku = props.department.name.ku
    form.name_ar = props.department.name.ar
    form.code = props.department.code
    form.college_id = props.department.college_id
    form.study_system = props.department.study_system
    form.stages = props.department.stages
    form.ects_count = props.department.ects_count

  }
  else {
    form.name_en =  ''
    form.name_ku =  ''
    form.name_ar =  ''
    form.code =  ''
    form.college_id =  ''
    form.study_system =  ''
    form.stages =  ''
    form.ects_count =  ''
  }
})

</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 900"
    :model-value="props.isDialogVisible"
    @update:model-value="onReset"
  >
    <DialogCloseBtn @click="onReset" />

    <VCard class="pa-sm-4 pa-5">
      <VCardItem class="pa-0">
        <VCardTitle class="pa-0 ma-0 text-h4 mb-2 mt-2">
          {{ props.college ? 'Edit' : 'Add New' }} Department
        </VCardTitle>
      </VCardItem>
      <VCardText>
          <ErrorMessages :errors="form.errors" />
          <VForm @submit.prevent="submit">
            <VRow>
                <VCol cols="6">
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
                                label="Department Code"
                                type="text"
                            />
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="6">
                    <VRow>
                        <VCol cols="12">
                            <AppSelect
                                v-model="form.college_id"
                                class=""
                                :items="colleges"
                                item-title="name.en"
                                item-value="id"
                                placeholder="Select College"
                                label="College"
                            />
                        </VCol>
                        <VCol cols="12">
                            <AppSelect
                                v-model="form.study_system"
                                label="Study System"
                                :items="['Bologna','Semester','Yearly' ]"
                            />
                        </VCol>
                        <VCol cols="12">
                            <AppSelect
                                v-model="form.stages"
                                label="Stages"
                                :items="[1,2,3,4,5]"
                            />
                        </VCol>
                        <VCol cols="12" v-show="form.study_system == 'Bologna'">
                            <AppTextField
                                v-model="form.ects_count"
                                label="No. of ECTS"
                                type="text"
                            />
                        </VCol>
                    </VRow>
                </VCol>
            </VRow>
            <VRow>
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
