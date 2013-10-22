/**
 * Every rich text editor plugin is expected to come with a wysiwyg.js file,
 * and should follow the same structure.
 *
 * This makes sure there is consistency among multiple RTE plugins.
 */
if (typeof Dna.Wysiwyg == 'undefined') {
	// Dna.uploadsPath and Dna.attachmentsPath is set from Helper anyways
	Dna.Wysiwyg = {
		uploadsPath: Dna.basePath + 'uploads/',
		attachmentsPath: Dna.basePath + 'file_manager/attachments/browse'
	};
}

/**
 * This function is called when you select an image file to be inserted in your editor.
 */
Dna.Wysiwyg.choose = function(url, title, description) {

};

/**
 * This function is responsible for integrating attachments/file browser in the editor.
 */
Dna.Wysiwyg.browser = function() {

};

if (typeof jQuery != 'undefined') {
	$(document).ready(function() {
		Dna.Wysiwyg.browser();
	});
}
