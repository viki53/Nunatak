<template>
	<fieldset class="card mt-3">
		<h3 class="card-header"><label v-bind:for="this.id + '_editor'" @click="">{{ header }}</label></h3>

		<div class="card-body">
			<div class="form-group">
				<textarea name="content" v-bind:required="required" hidden v-html="contentCopy"></textarea>
				<div v-bind:id="this.id + '_editor'" class="form-control" v-bind:class="{ 'is-invalid': !!error }" name="content" v-html="content"></div>

				<span v-if="error" class="invalid-feedback" role="alert">
					<strong>{{ error }}</strong>
				</span>
			</div>
		</div>
	</fieldset>
</template>

<script>
    export default {
		props: {
			content: String,
			error: String,
			header: String,
			id: String,
			required: Boolean
		},
		data() {
			return {
				contentCopy: '',
			}
		},
		focusEditor() {
			this.pageEditorQuill.focus();
		},
        mounted() {
			const fallback = document.querySelector(`[data-fallback="${this.id}"]`);
			if (fallback) {
				fallback.parentNode.removeChild(fallback);
			}

			this.contentCopy = this.content + '';

			this.pageEditorQuill = new Quill(`#${ this.id }_editor`, {
				theme: 'snow',
				scrollingContainer: `#${this.id}_editor`
			});
			this.pageEditorQuill.on('text-change', (delta) => {
				this.contentCopy = this.pageEditorQuill.root.innerHTML;
			})
        }
    }
</script>

<style lang="scss" scoped>
	.form-control {
		min-height: 15em;
	}
</style>
