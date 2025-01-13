<template>
    <table class="table">

        <tbody>
        <tr>
        <td>Курс:</td>
        <td>
            <select v-model="selectedCourse" name="curs_id" class="form-select" @change="fetchSteps(selectedCourse)">
                <option value="">Выберите курс</option>
                <option v-for="course in courses" :key="course.id" :value="course.id">
                    {{ course.name }}
                </option>
            </select>
        </td>
    </tr>

    <tr>
        <td>Предыдущий шаг:</td>
        <td>
            <select v-model="selectedPreviousStep" name="previous_id" class="form-select" :disabled="!selectedCourse">
                <option value="">Нет</option>
                <option v-for="step in steps" :key="step.id" :value="step.id">
                    {{ step.name }}
                </option>
            </select>
        </td>
    </tr>
    </tbody>
    </table>
</template>

<script>
export default {
    props: {
        availableCourses: {
            type: Array,
            default: () => [],
        },
        cursId: {
            type: Number,
            default: null,
        },
        currentStepId: {
            type: Number,
            default: null,
        },
        initialStepId: {
            type: Number,
            default: null,
        },
    },
    data() {
        return {
            courses: this.availableCourses,
            selectedCourse: this.cursId,
            selectedPreviousStep: this.initialStepId,
            steps: [],
        };
    },
    watch: {
        selectedCourse(newCursId) {
            this.fetchSteps(newCursId);
        },
    },
    methods: {
        fetchSteps(cursId) {
            if (!cursId) {
                this.steps = [];
                this.selectedPreviousStep = null;
                return;
            }

            axios
                .post('/admin/steps/get-steps-by-course', {
                    curs_id: cursId,
                    current_step_id: this.currentStepId,
                })
                .then((response) => {
                    this.steps = response.data;
                })
                .catch((error) => {
                    console.error('Ошибка загрузки шагов:', error);
                });
        },
    },
    mounted() {
        if (this.selectedCourse) {
            this.fetchSteps(this.selectedCourse);
        }
    },
};
</script>
