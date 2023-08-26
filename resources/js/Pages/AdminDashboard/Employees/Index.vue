<template>
    <h2>Employees</h2>
    <DeleteAlert v-if="deleteId" :id="deleteId" @close="deleteId = false" :url="'/admin-dashboard/employees/'"
        :text="'Deleting the employee will permanently removed from the database. You can\'t recover the data again. Are you sure about deleting?'">
    </DeleteAlert>
    <TableLayout>
        <TableNew :data="users.data" :tableContent="[
            // { heading: 'Logo', type: 'image', value: 'logo_url' },
            { heading: 'First Name', type: 'text', value: 'first_name' },
            { heading: 'Last Name', type: 'text', value: 'last_name' },
            { heading: 'Email', type: 'text', value: 'email' },
            { heading: 'Phone Number', type: 'text', value: 'phone' },
        ]" :actionLinks="[{ link: 'admin-dashboard/employees', name: 'Edit' }]" :deleteEnable="true"
            @deleteItem="(id) => deleteId = id"></TableNew>
        <PageNavigation :data="users"></PageNavigation>
    </TableLayout>
</template>
<script>
export default {
    props: ["roles", "filters", 'users'],
    data() {
        return {
            deleteId: false,
        };
    }
};
</script>
<script setup>
import PageNavigation from "../../../Shared/Table/PageNavigation.vue";
import Filters from "../../../Shared/Filters/Filters.vue";
import DeleteAlert from "../../../Shared/DeleteAlert.vue";
import TableNew from "../../../Shared/Table/Table.vue";
import TableLayout from "../../../Shared/Table/TableLayout.vue";
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
