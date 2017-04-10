define(["jquery", "backbone"],

   function($, Backbone) 
   {
	 	 // View for one box
		ShopView = Backbone.View.extend({
			el: $("#appShop"),
			className : 'shop-list-item',
			initialize: function (options) {
				options || (options = {});

			},
			update : function(el){

			},
			render : function(){
			
				// Keep view reference
				var self = this;
				// Set id from model to box div
				var elements = jQuery('<div/>', {
					id: 'foo',
					href: 'http://google.com',
					title: 'Become a Googler',
					rel: 'external',
					text: 'Go to Google!'
				});

				// Set the the css infos from model to the div and bind draggable and resizable then append the elements to it.
				this.$el.append(elements);
				
				return this;		
			}
		});

		return ShopView;
		
	}
);