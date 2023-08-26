<template>
    <!-- Modal content -->
    <Modal :modalHeadingText="'Create new Company'" :modalHeadingResetButton="true" :modalWidth="2">
        <template #body>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput :label="'Company Name'" :name="'name'" :type="'text'" v-model="userInfo.name"
                        :error="errors.name">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Email'" :name="'email'" :type="'email'" v-model="userInfo.email"
                        :error="errors.email">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Website'" :name="'website'" :type="'text'" v-model="userInfo.website"
                        :error="errors.website">
                    </FormSimpleInput>
                    <!-- <FormSelect :label="'Assign Course'" :name="'course_id'" :selected="courseId"
                        v-model="userInfo.course_id" :error="errors.course_id" :optionsArray="courses" :optionName="'name'"
                        :optionValue="'id'">
                    </FormSelect> -->
                </div>
                <div>
                    <FormFileUploadSingle @fileChange="(file) => (userInfo.logo = file[0])" :label="'Logo Image'"
                        :oldImageLink="''" :rounded="true" :name="'logo'" :hideInputBox="true"
                        :error="errors.logo"></FormFileUploadSingle>
                </div>
            </div>

        </template>
        <template #footer>
            <Button
                @click.prevent="createRequest({ url: '/admin-dashboard/companies', data: userInfo, only: ['flash', 'errors'] })"
                :text="'Create Company'" :color="'blue'"></Button>
        </template>
    </Modal>
</template>
<script>

export default {
    props: ["errors", "roles"],
    data() {
        return {
            userInfo: { roles: [] }
        };
    },
    mounted() {
        this.userInfo.tac = true
    },
};
</script>
<script setup>
import Button from "../../../Shared/FormElements/Button.vue";
import FormSimpleInput from "../../../Shared/FormElements/FormSimpleInput.vue";
import FormFileUploadSingle from "../../../Shared/FormElements/FormFileUploadSingle.vue";
import Modal from "../../../Shared/Modal/Modal.vue";
import FormCheckBox from "../../../Shared/FormElements/FormCheckBox.vue";
import FormSelect from "../../../Shared/FormElements/FormSelect.vue";

import { createRequest } from '../../../main.js'

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})


</script>
