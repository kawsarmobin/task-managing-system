<template>
<div class="card bg-light mb-3">
    <div class="card-header">All Task</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>User</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(task,index) in tasks" :key="index">
                    <td>{{ ++index }}</td>
                    <td class="text-capitalize">{{ task.title }}</td>
                    <td class="text-capitalize">{{ task.user.name }}</td>
                    <td>{{ task.deadline }}</td>
                    <td>{{ task.status }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary" @click.prevent="showTask(task)">Show</button>
                        <app-user-task-show :task="task" :modalId="'task'+task.id"></app-user-task-show>
                        <button @click.prevent="deleteTask(task)" class="btn btn-sm btn-outline-danger">
                            Delete
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
            axios.get(`/tms/admin/tasks`)
            .then(res => {
                this.tasks = res.data.data;
            })
        },
        deleteTask(task){
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'})
            .then((result) => {
                if (result.value) {
                    axios.delete(`/tms/admin/tasks/`+task.id)
                    .then(res => {
                        this.getTasks();
                        toast.fire({
                            type: 'success',
                            title: 'Task has been deleted successfully'
                        })
                    })
                }
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

