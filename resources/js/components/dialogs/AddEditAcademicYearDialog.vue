<script setup>
import { VForm } from 'vuetify/components/VForm'
import ErrorMessages from "@/components/ErrorMessages.vue";

import { useForm } from "@inertiajs/vue3";


const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  academic_year: Object,
})

const emit = defineEmits([
  'update:isDialogVisible', 'actionReturn'
])

const form = useForm({
    year_from: "",
    year_to: "",
    start_date: "",
    end_date: "",
    status: "Active",
});

const submit = () => {
    if(props.academic_year){
        form.put('academic-years/'+props.academic_year.id, {
            onSuccess: () => {
                emit('update:isDialogVisible', false)
                emit('actionReturn')
            },
        });
    }else {
        form.post('academic-years', {
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
  if(props.academic_year){
    form.year_from = props.academic_year.year_from
    form.year_to = props.academic_year.year_to
    form.start_date = props.academic_year.start_date
    form.end_date = props.academic_year.end_date
    form.status = props.academic_year.status
  }
  else {
    form.year_from = ''
    form.year_to = ''
    form.start_date = ''
    form.end_date = ''
    form.status = 'Active'
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
          {{ props.college ? 'Edit' : 'Add New' }} Academic Year
        </VCardTitle>
      </VCardItem>
      <VCardText>
          <ErrorMessages :errors="form.errors" />
          <VForm @submit.prevent="submit">
            <VRow>
                <VCol cols="12">
                    <AppTextField
                    v-model="form.year_from"
                    autofocus
                    label="Year From"
                    type="text"
                    />
                </VCol>

                <VCol cols="12">
                    <AppTextField
                    v-model="form.year_to"
                    label="Year To"
                    type="text"
                    />
                </VCol>

                <VCol cols="12">
                    <AppTextField
                    v-model="form.start_date"
                    label="Start Date"
                    type="date"
                    />
                </VCol>

                <VCol cols="12">
                    <AppTextField
                    v-model="form.end_date"
                    label="End Date"
                    type="date"
                    />
                </VCol>
                <VCol cols="12">
                    <AppSelect
                        v-model="form.status"
                        label="Status"
                        :items="['Active','Disabled']"
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
