<script setup>
import PaginationLinks from "@/components/PaginationLinks.vue";
import moment from 'moment'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  data: Object,
})

const isDialogVisible = ref(false)
const selectedItem = ref()

const search = ''

// Headers
const headers = [
  {
    title: 'ID',
    key: 'id',
  },
  {
    title: 'Year From',
    key: 'year_from',
  },
  {
    title: 'Year To',
    key: 'year_to',
  },
  {
    title: 'Start Date',
    key: 'start_date',
  },
  {
    title: 'End Date',
    key: 'end_date',
  },
  {
    title: 'Status',
    key: 'status',
  },
  {
    title: 'Created at',
    key: 'created_at',
  },
  {
    title: 'Actions',
    key: 'actions',
    sortable: false,
  },
]

const form = useForm({});

const deleteRecord = (id) => {
  // This is a simple confirmation message, to be enhanced later with a confirmation model - Abed Said
  if(confirm("Do you really want to delete?")){

    form.delete(`academic-years/${id}`);
 
  }
}

const actionReturn = () => {
  selectedItem.value = null

}

</script>

<template>
  <section>
    <Head title="Academic Years" /> 
    <Alert v-if="$page?.props.flash?.status" :status="$page?.props.flash?.status" />

    <vue3-confirm-dialog/>
    <VRow>
      <VCol cols="12" class="d-flex align-center">
        <VIcon
            size="30"
            icon="tabler-calendar"
            class="ma-2"
          />
        <h4 class="text-h4 mb-1">
            Academic Years
        </h4>
        
      </VCol>
    </VRow>
    <VRow>
      <VCol cols="12">
        <VCard>
          <VCardText class="d-flex flex-wrap gap-4">
            <VSpacer />
            <div class="d-flex  flex-wrap gap-4 ">
              <div style="inline-size: 15.625rem;">
                <AppTextField
                  v-model="search"
                  placeholder="Search Academic Years"
                />
              </div>
              <VBtn
                prepend-icon="tabler-plus"
                @click="isDialogVisible = true"
              >
                Add Academic Years
              </VBtn>
            </div>
          </VCardText>
          
          
          <!-- SECTION datatable -->
          <VDataTable
            :items="data.data"
            :headers="headers"
            class="text-no-wrap"
          >
           

            <template #item.created_at="{ item }">
              {{ moment(item.created_at).format("MM/DD/YYYY, h:mm A") }}
            </template>

            <!-- Actions -->
          <template #item.actions="{ item }">
            <IconBtn @click="deleteRecord(item.id)">
              <VIcon icon="tabler-trash"  />
            </IconBtn>

            <IconBtn  @click="isDialogVisible = true, selectedItem = item">
              <VIcon icon="tabler-pencil"/>
            </IconBtn>

          </template>
            
            
            <!-- pagination -->
            <template #bottom>
              <VDivider />
              <PaginationLinks :links="data.links" />
              
            </template>
          </VDataTable>
          <!-- SECTION -->
        </VCard>

      </VCol>
    </VRow>
    <AddEditAcademicYearDialog
      v-model:isDialogVisible="isDialogVisible"
      v-model:academic_year="selectedItem"
      @action-return="actionReturn"

    />
  </section>
</template>

