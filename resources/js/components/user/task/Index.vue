<template>
<div class="card bg-light mb-3">
    <div class="card-header">All Task</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(task,index) in tasks" :key="index">
                    <td>{{ ++index }}</td>
                    <td class="text-capitalize">{{ task.title }}</td>
                    <td>{{ task.deadline }}</td>
                    <td>{{ task.status }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary" @click.prevent="showTask(task)">Show</button>
                        <app-task-show :task="task" :modalId="'task'+task.id"></app-task-show>
                        <button v-if="task.pending" @click.prevent="completeTask(task)" class="btn btn-sm btn-outline-success">
                            Complete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return {
            tasks: [],
        }
    },
    methods: {
        getTasks(){
            axios.get(`/tasks`)
            .then(res => {
                this.tasks = res.data.data;
            })
        },
        completeTask(task){
            axios.post(`/task/${task.id}/complete`)
            .then(res => {
                this.getTasks();
            })
        },
        showTask(task){
           $('#task'+task.id).modal('show');
        }
    },
    created(){
        this.getTasks();
    }
}
</script>

