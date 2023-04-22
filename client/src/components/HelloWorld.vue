<template>
  <div>
    <div class="container">
<!--      <b-button v-b-modal.createTaskModal class="mt-2" variant="primary">Create New Task</b-button>-->
<!--      <b-modal id="createTaskModal" title="Task Details">-->
<!--        -->
<!--      </b-modal>-->

      <b-button class="mt-2" v-b-modal.modal-prevent-closing variant="primary">Create New Task</b-button>



      <b-modal
        id="modal-prevent-closing"
        ref="modal"
        title="Submit Your Name"
        @show="resetModal"
        @hidden="resetModal"
        @ok="handleOk"
      >
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-group
            label="Title"
            label-for="title-input"
            invalid-feedback="Title is required"
            :state="titleState"
          >
            <b-form-input
              id="title-input"
              v-model="form.title"
              :state="titleState"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group
            label="Text"
            label-for="text-input"
            invalid-feadback="Text is required"
            :state="textState"
          >
            <b-form-textarea
              id="text-input"
              v-model="form.text"
              :state="textState"
              required
              rows="3"
              max-rows="6"

            ></b-form-textarea>
          </b-form-group>

          <b-form-group
            label="Status"
            label-for="status-select"
            invalid-feadback="Status is required"
            :state="statusState"
          >
            <b-form-select
              v-model="form.status"
              :options="options"
              size="sm"
              class="mt-3 form-control"
              :state="statusState"
              required
            ></b-form-select>
          </b-form-group>

        </form>
      </b-modal>


<!--      //Edit Modal-->
      <b-modal
        id="edit-modal"
        ref="modal"
        title="Submit Your Name"
        @show="resetModal"
        @hidden="resetModal"
        @ok="handleOk"
      >
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-group
            label="Title"
            label-for="title-input"
            invalid-feedback="Title is required"
            :state="titleState"
          >
            <b-form-input
              id="title-input"
              v-model="form.title"
              :state="titleState"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group
            label="Text"
            label-for="text-input"
            invalid-feadback="Text is required"
            :state="textState"
          >
            <b-form-textarea
              id="text-input"
              v-model="form.text"
              :state="textState"
              required
              rows="3"
              max-rows="6"

            ></b-form-textarea>
          </b-form-group>

          <b-form-group
            label="Status"
            label-for="status-select"
            invalid-feadback="Status is required"
            :state="statusState"
          >
            <b-form-select
              v-model="form.status"
              :options="options"
              size="sm"
              class="mt-3 form-control"
              :state="statusState"
              required
            ></b-form-select>
          </b-form-group>

        </form>
      </b-modal>
      <h2 class="mt-2 mb-2">TASK LIST</h2>
      <hr>
      <b-table striped hover :items="tasks" :fields="fields">
        <template v-slot:cell(options)="data" >


          <b-button class="mt-2" v-b-modal.edit-modal variant="success">Edit</b-button>




        </template>
      </b-table>
    </div>
  </div>
</template>

<script>

import axios from "axios";

export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      form:{
        title:'',
        text:'',
        status:null
      },
      editForm:{
        title:'',
        text:'',
        status:null
      },

      titleState: null,
      textState: null,
      statusState: null,
      fields:[
        'title',
        'text',
        'status',
        'created_at',
        'options'
      ],
      selected: null,
      options: [
        { value: null, text: 'Select Status', disabled:true },
        { value: 'todo', text: 'Todo' },
        { value: 'reject', text: 'Reject' },
        { value: 'inProgress', text: 'In Progress' },
        { value: 'completed',  text: 'Completed' },
      ]
    }
  },
  computed:{
    tasks() {
      return this.$store.getters['tasks']
    }
  },
  mounted() {
    this.$store.dispatch('fetchAllTasks')
  },
  methods: {
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity()
      this.titleState = valid
      this.textState = valid
      this.statusState = valid
      return valid
    },
    resetModal() {
      this.form.title = '';
      this.form.text = '';
      this.form.status = '';
      this.titleState = null
      this.textState = null
      this.statusState = null
    },
    handleOk(bvModalEvent) {
      // Prevent modal from closing
      bvModalEvent.preventDefault()
      // Trigger submit handler
      this.handleSubmit()
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return
      }
      // Send form

      axios.post("http://127.0.0.1:8000/api/tasks/store", this.form).then(response => {
        alert(response.data.message);
        this.$nextTick(() => {
          this.$bvModal.hide('modal-prevent-closing')
        })
      })



      console.log(this.form)
      // Hide the modal manually
      // this.$nextTick(() => {
      //   this.$bvModal.hide('modal-prevent-closing')
      // })
    }
  }

}
</script>

<style scoped>

</style>
