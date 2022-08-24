<template>
  <h1>Перечень текущих дел</h1>
  <form @submit.prevent="addTodoList()">
    <label>Создать дело</label>
    <input v-model="newTodo" name="newTodo" autocomplete="off" />
    <button>Добавить</button>
  </form>
  <h2>Список</h2>
  <ul>
    <li v-for="todo in todos" :key="todo.id">
      <span :class="{ done: false }">{{ todo.name }}</span>
      <button @click="deleteTodoList(todo.id)">Удалить</button>
    </li>
  </ul>
  <h4 v-if="todos.length === 0">Список пуст</h4>
</template>

<script>
import { onMounted, ref } from "vue";
export default {
  name: "App",

  props: {
    list: Array,
  },

  setup(props) {
    const newTodo = ref("");
    const todos = ref(props.list);

    // Echo.private(`channel-todolist`).listen("TodoListChange", (e) => {
    //   console.log(e.success);
    // });

    Echo.channel(`channel-todolist`).listen("TodoListChange", (e) => {
      console.log(e.success);

      if (e.success) {
        allTodoList();
      }
    });

    function addTodoList() {
      axios
        .post("http://todolist.loc/api/addtodolist", { name: newTodo.value })
        .then((response) => {
          console.log(response.data);

          // if (response.data) {
          //   allTodoList();
          // }
        });

      newTodo.value = "";
    }

    function allTodoList() {
      todos.value = [];

      axios.get("http://todolist.loc/api/alltodolist").then((response) => {
        console.log(response.data);

        for (var i = 0; i < response.data.length; i++) {
          todos.value.push(response.data[i]);
        }
      });
    }

    function deleteTodoList(id) {
      axios.delete("http://todolist.loc/api/deletetodolist/" + id).then((response) => {
        console.log(response.data);
        // if (!!response.data) {
        //   allTodoList();
        // }
      });
    }

    return {
      todos,
      newTodo,
      addTodoList,
      deleteTodoList,
      allTodoList,
    };
  },
};
</script>

<style lang="scss">
$border: 2px solid
  rgba(
    $color: white,
    $alpha: 0.35,
  );
$size1: 6px;
$size2: 12px;
$size3: 18px;
$size4: 24px;
$size5: 48px;
$backgroundColor: #27292d;
$textColor: white;
$primaryColor: #a0a4d9;
$secondTextColor: #1f2023;
body {
  margin: 0;
  padding: 0;
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  background-color: $backgroundColor;
  color: $textColor;
  #app {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    padding: 20px;
    h1 {
      font-weight: bold;
      font-size: 28px;
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
      width: 100%;
      label {
        font-size: 14px;
        font-weight: bold;
      }
      input,
      button {
        height: $size5;
        box-shadow: none;
        outline: none;
        padding-left: $size2;
        padding-right: $size2;
        border-radius: $size1;
        font-size: 18px;
        margin-top: $size1;
        margin-bottom: $size2;
      }
      input {
        background-color: transparent;
        border: $border;
        color: inherit;
      }
    }
    button {
      cursor: pointer;
      background-color: $primaryColor;
      border: 1px solid $primaryColor;
      color: $secondTextColor;
      font-weight: bold;
      outline: none;
      border-radius: $size1;
    }
    h2 {
      font-size: 22px;
      border-bottom: $border;
      padding-bottom: $size1;
    }
    ul {
      padding: 10px;
      li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: $border;
        padding: $size2 $size4;
        border-radius: $size1;
        margin-bottom: $size2;
        span {
          cursor: pointer;
        }
        .done {
          text-decoration: line-through;
        }
        button {
          font-size: $size2;
          padding: $size1;
        }
      }
    }
    h4 {
      text-align: center;
      opacity: 0.5;
      margin: 0;
    }
  }
}
</style>
