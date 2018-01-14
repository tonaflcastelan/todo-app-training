<template>
	<tr>
		<td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': todo.done }" @click="$parent.toggleDone(todo)">
			{{ todo.text }}
		</td>
		<td class="is-narrow">
			<a class="button is-danger is-small" @click="$parent.removeTodo(todo)">Eliminar</a>
		</td>
	</tr>
</template>
<script>
	export default {
	    props: ['todo']
	}
</script>0