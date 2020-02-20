module.exports = {
	methods: {
		/**
		* Translate the given key.
		*/
		__(key, replace) {
			let translation, translationNotFound = true

			try {
				translation = key.split('.').reduce((t, i) => t[i] || null, window._translations.php)
				if (translation) {
					translationNotFound = false
				}
			} catch (e) {
				translation = key
			}

			if (translationNotFound) {
				translation = window._translations.json[key]
				? window._translations.json[key]
				: key
			}

			Object.keys(replace || {}).forEach((key) => {
				translation = translation.replace(":" + key, replace[key])
			})

			return translation
		}
	},
}
