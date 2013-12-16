/**
 * Initialize Annotator
 *
 * @param options
 */
function initAnnotator(options, base_url){
	$(document).ready(function(){
		$(options.selector).each(function(){
	        var content = $(this).annotator();

			if(options.plugins){
			 	for (var i = 0; i < options.plugins.length; i++) {
		        	switch(options.plugins[i]){
		        		case "store":
		        			annotatorStorePluginInit(base_url, options, content);
		        		break;
		        	}
		        }
		    }
		});
	});
}

function annotatorStorePluginInit(base_url, plugin_settings, content_selector){
	var annotator_store_metadata = {'uri' : document.URL};

	if(typeof plugin_settings.metadata != 'undefined'){
		for(index in plugin_settings.metadata){
			annotator_store_metadata[index] = plugin_settings.metadata[index];
		}
	}

	content_selector.annotator('addPlugin', 'Store', {
		prefix: base_url + '/annotations',
		
		urls: {
		    create:  '/save',
		    read:    '/:id',
		    update:  '/save/:id',
		    destroy: '/delete/:id',
		    search:  '/search'
		},

		annotationData: annotator_store_metadata,

		loadFromSearch: annotator_store_metadata
	});
}