<template>
<div class="card bg-light mb-3">
    <div class="card-header">Task Create</div>
    <div class="card-body">
        <form @submit.prevent="storeData()">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="Title" v-model="form.title">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="des" v-model="form.des"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deadline</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="deadline" v-model="form.deadline">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                    <input @change.prevent="onFileChange" type="file" class="form-control-file" name="file">
                </div>
            </div>
            <div class="float-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return {
            form: new Form({
                title: '',
                des: '',
                deadline: '',
                file: '',
            }),
        }
    },
    methods: {
        storeData(){
            this.form.post(`/admin/tasks`)
            .then(res => {
                console.log(res.data.data);
            })
        },
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.form.file = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    }
}
</script>
