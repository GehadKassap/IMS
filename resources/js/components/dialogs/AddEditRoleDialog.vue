<script setup>
import { VForm } from 'vuetify/components/VForm'

const props = defineProps({
  role: {
    type: Object,
    required: false,
    default: () => ({
      name: '',
      permissions: [],
    }),
  },
  permissionsList: Array,
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
})

const rolePermissions = ref(props.role.permissions)


const emit = defineEmits([
  'update:isDialogVisible',
  'update:rolePermissions',
])

const onReset = () => {
  emit('update:isDialogVisible', false)
}

</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 900"
    :model-value="props.isDialogVisible"
    @update:model-value="onReset"
  >
    <!-- 👉 Dialog close btn -->
    <DialogCloseBtn @click="onReset" />

    <VCard class="pa-sm-10 pa-2">
      <VCardText>
        <!-- 👉 Title -->
        <h4 class="text-h4 text-center mb-2">
          {{ props.role.name ? 'Edit' : 'Add New' }} Role
        </h4>
        <p class="text-body-1 text-center mb-6">
          Set Role Permissions
        </p>

        <!-- 👉 Form -->
        <VForm ref="refPermissionForm">
          <!-- 👉 Role name -->
          <AppTextField
            v-model="role.name"
            label="Role Name"
            placeholder="Enter Role Name"
            class="text-capitalize"
          />

          <h5 class="text-h5 my-6">
            Role Permissions
          </h5>

          <!-- 👉 Role Permissions -->

          <VTable class="permission-table text-no-wrap mb-6">
            <!-- 👉 Admin  -->
            <tr>
              <td>
                <h6 class="text-h6">
                  Permission
                </h6>
              </td>
              <td colspan="3">
                Select
              </td>
            </tr>

            <!-- 👉 Other permission loop -->
            <template
              v-for="permission in permissionsList"
              :key="permission.id"
            >
              <tr>
                <td>
                  <h6 class="text-h6">
                    {{ permission.name }}
                  </h6>
                </td>
                
                <td>
                  <div class="d-flex justify-end">
                    <VCheckbox
                      v-model="rolePermissions"
                      :value="permission.id"
                    />
                  </div>
                </td>
              </tr>
            </template>
          </VTable>

          <!-- 👉 Actions button -->
          <div class="d-flex align-center justify-center gap-4">
            <VBtn @click="onSubmit">
              Submit
            </VBtn>

            <VBtn
              color="secondary"
              variant="tonal"
              @click="onReset"
            >
              Cancel
            </VBtn>
          </div>
        </VForm>
      </VCardText>
    </VCard>
  </VDialog>
</template>

<style lang="scss">
.permission-table {
  td {
    border-block-end: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
    padding-block: 0.5rem;

    .v-checkbox {
      min-inline-size: 4.75rem;
    }

    &:not(:first-child) {
      padding-inline: 0.5rem;
    }

    .v-label {
      white-space: nowrap;
    }
  }
}
</style>
