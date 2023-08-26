<template>
    <h2>Companies</h2>
    <DeleteAlert v-if="deleteId" :id="deleteId" @close="deleteId = false" :url="'/admin-dashboard/companies/'"
        :text="'Deleting the company will permanently removed from the database. You can\'t recover the data again. Are you sure about deleting?'">
    </DeleteAlert>
    <TableLayout>
        <TableNew :data="users.data" :tableContent="[
            { heading: 'Logo', type: 'image', value: 'logo_url' },
            { heading: 'Name', type: 'text', value: 'name' },
            { heading: 'Email', type: 'text', value: 'email' },
            { heading: 'Website', type: 'text', value: 'website' },
        ]" :actionLinks="[{ link: 'admin-dashboard/companies', name: 'Edit' }]" :deleteEnable="true"
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
