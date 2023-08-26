<template>
    <!-- Modal content -->
    <Modal :modalHeadingText="'Edit Employee'" :modalHeadingResetButton="true" :modalWidth="2">
        <template #body>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput :label="'First Name'" :name="'first_name'" :type="'text'" v-model="userInfo.first_name"
                        :error="errors.first_name">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Last Name'" :name="'last_name'" :type="'text'" v-model="userInfo.last_name"
                        :error="errors.last_name">
                    </FormSimpleInput>

                    <FormSimpleInput :label="'Email'" :name="'email'" :type="'email'" v-model="userInfo.email"
                        :error="errors.email">
                    </FormSimpleInput>

                    <!-- <FormSelect :label="'Assign Course'" :name="'course_id'" :selected="courseId"
                        v-model="userInfo.course_id" :error="errors.course_id" :optionsArray="courses" :optionName="'name'"
                        :optionValue="'id'">
                    </FormSelect> -->
                </div>
                <div>
                    <FormSimpleInput :label="'Company Id'" :name="'name'" :type="'text'" v-model="userInfo.company_id"
                        :error="errors.company_id">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Phone Number'" :name="'phone_number'" :placeholder="'+91'" :type="'text'"
                    v-model="userInfo.phone" :error="errors.phone">
                </FormSimpleInput>
                 
                </div>
            </div>
        </template>
        <template #footer>
            <Button @click.prevent="
                editRequest({
                    url: '/admin-dashboard/employees/',
                    data: userInfo,
                    dataId: user.id,
                    only: ['flash', 'errors', 'user'],
                })
                " :text="'Edit Employee'" :color="'blue'"></Button>
        </template>
    </Modal>
</template>
<script>
export default {
    props: ["errors", "roles", "user", "user_roles"],
    data() {
        return {
            userInfo: Object.assign({ roles: this.user_roles }, this.user),
        };
    },
    mounted() {
        this.userInfo.tac = true;
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

import { editRequest } from "../../../main.js";

import { onMounted } from "vue";
import { initFlowbite } from "flowbite";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
