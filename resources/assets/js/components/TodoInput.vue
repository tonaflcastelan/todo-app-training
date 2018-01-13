<template>
    <div class="box">
        <div class="field is-grouped">
            <p class="control is-expanded">
                <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="$parent.todoItemText" name="text">
            </p>
            <p class="control">
                <a class="button is-info" v-on:click="$parent.addTodo()">Agregar</a>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>