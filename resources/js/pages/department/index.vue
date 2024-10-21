<script setup>
import PaginationLinks from "@/components/PaginationLinks.vue";
import moment from 'moment'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  data: Object,
  colleges: Array,
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
    title: 'Name',
    key: 'name',
  },
  {
    title: 'Code',
    key: 'code',
  },
  {
    title: 'College',
    key: 'college',
  },
  {
    title: 'Study System',
    key: 'study_system',
  },
  {
    title: 'Stages',
    key: 'stages',
  },
  {
    title: 'No. ECTS',
    key: 'ects_count',
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

    form.delete(`departments/${id}`);
 
  }
}

const actionReturn = () => {
  selectedItem.value = null

}

</script>

<template>
  <section>
    <Head title="Departments" /> 
    <Alert v-if="$page?.props.flash?.status" :status="$page?.props.flash?.status" />

    <vue3-confirm-dialog/>
    <VRow>
      <VCol cols="12" class="d-flex align-center">
        <VIcon
            size="30"
            icon="tabler-box-multiple"
            class="ma-2"
          />
        <h4 class="text-h4 mb-1">
          Departments
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
                  placeholder="Search Departments"
                />
              </div>
              <VBtn
                prepend-icon="tabler-plus"
                @click="isDialogVisible = true"
              >
                Add Department
              </VBtn>
            </div>
          </VCardText>
          
          
          <!-- SECTION datatable -->
          <VDataTable
            :items="data.data"
            :headers="headers"
            class="text-no-wrap"
          >
            <template #item.name="{ item }">
              <span class="font-weight-medium">{{ item.name?.en }}</span>
            </template>

            <template #item.college="{ item }">
              <span class="font-weight-medium">{{ item.college?.name?.en }}</span>
            </template>

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
    <AddEditDepartmentDialog
      v-model:isDialogVisible="isDialogVisible"
      v-model:department="selectedItem"
      v-model:colleges="props.colleges"
      @action-return="actionReturn"

    />
  </section>
</template>

