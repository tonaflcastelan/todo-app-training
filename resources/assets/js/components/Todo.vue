<template>
    <div class="container">
        <todo-input></todo-input>
        <table class="table is-bordered">
            <tr v-for="(todo, index) in items" :key="index">
                <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': todo.done }" @click="toggleDone(todo)">
                    {{ todo.text }}
                </td>
                <td class="is-narrow">
                    <a class="button is-danger is-small" @click="removeTodo(todo)">Eliminar</a>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */
    export default {
        data () {
            return {
                todoItemText: '',
                items: [],
                errors: '',
            }
        },
        mounted () {
            this.getTodo();
        },
        methods: {
            getTodo: function() {
                axios.get('api/todos').then(response => {
                    this.items = response.data
                });
            },
            addTodo () {
                axios.post('api/todos', {
                    text: this.todoItemText,
                    done: false
                }).then((res) => {
                    this.todoItemText = '',
                    this.errors = [];
                    this.getTodo();
                }).catch(error => {
                    this.errors = 'Ocurrió un error al guardar'
                });
            },
            removeTodo (todo) {
                axios.delete('api/todos/' + todo.id).then(response => {
                    this.getTodo();
                });
            },
            toggleDone (todo) {
                todo.done = !todo.done
                axios.put('api/todos/' + todo.id, {done: todo.done}).then(response => {
                    this.errors   = [];
                    this.getTodo();
                }).catch(error => {
                    this.errors = 'Corrija para poder editar con éxito'
                });
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
