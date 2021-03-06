/**
 * Vocabularies
 *
 * for VocabulariesController
 */
var Vocabularies = {};

/**
 * functions to execute when document is ready
 *
 * only for VocabulariesController
 *
 * @return void
 */
Vocabularies.documentReady = function() {

}

/**
 * Create slugs based on title field
 *
 * @return void
 */
Vocabularies.slug = function() {
	$("#VocabularyTitle").slug({
		slug:'alias',
		hide: false
	});
}

/**
 * document ready
 *
 * @return void
 */
$(document).ready(function() {
	if (Dna.params.controller == 'vocabularies') {
		Vocabularies.documentReady();
		if (Dna.params.action == 'admin_add') {
			Vocabularies.slug();
		}
	}
});