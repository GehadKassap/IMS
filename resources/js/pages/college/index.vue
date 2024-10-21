<script setup>
import PaginationLinks from "@/components/PaginationLinks.vue";
import moment from 'moment'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  data: Object,
})

const isDialogVisible = ref(false)
const selectedItem = ref(null)

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

    form.delete(`colleges/${id}`);
 
  }
}

const actionReturn = () => {
  selectedItem.value = null

}

</script>

<template>
  <section>
    <Head title="Colleges" /> 
    <Alert v-if="$page?.props.flash?.status" :status="$page?.props.flash?.status" />

    <vue3-confirm-dialog/>
    <VRow>
      <VCol cols="12" class="d-flex align-center">
        <VIcon
            size="30"
            icon="tabler-school"
            class="ma-2"
          />
        <h4 class="text-h4 mb-1">
          Colleges
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
                  placeholder="Search Colleges"
                />
              </div>
              <VBtn
                prepend-icon="tabler-plus"
                @click="isDialogVisible = true"
              >
                Add College
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
    <AddEditCollegeDialog
      v-model:isDialogVisible="isDialogVisible"
      v-model:college="selectedItem"
      @action-return="actionReturn"
    />
  </section>
</template>

