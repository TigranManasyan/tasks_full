import axios from "axios";

export default {
  state:{
    tasks:[]
  },
  mutations:{
    storeTasks:(state, data) => {
        state.tasks = data;
    }
  },
  getters:{
    tasks: state => state.tasks
  },
  actions: {
    fetchAllTasks(context) {
      axios.get("http://127.0.0.1:8000/api/tasks").then(response => {
        console.log(response.data)
            context.commit("storeTasks", response.data)
      })
    }
  }
}
