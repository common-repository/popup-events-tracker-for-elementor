(function( $ ) {
	$( window ).on( 'elementor/frontend/init', function() {
		new PetfeInit();
	});
})( jQuery );

class PetfeInit {

	constructor() {

		this.gaType = this.analyticsCheck();

		if ( this.gaType ) {
			elementorFrontend.elements.$document.on( 'elementor/popup/show', this.show.bind( this ) );
			elementorFrontend.elements.$document.on( 'elementor/popup/hide', this.hide.bind( this ) );
		}
	}

	show( event, id ) {
		this.event = event;
		this.id = id;

		const settings = this.getSettings();

		if ( this.shouldTrack() ) {
			new PetfeEventDispatcher( settings.popup_ga_tracking_category , 'show', settings.popup_ga_tracking_label, this.gaType );
		}

	}

	hide( event, id ) {
		this.event = event;
		this.id = id;

		const settings = this.getSettings();

		if ( this.shouldTrack() ) {
			new PetfeEventDispatcher( settings.popup_ga_tracking_category , 'hide', settings.popup_ga_tracking_label, this.gaType );
		}
	}

	shouldTrack() {
		const settings = this.getSettings();
		if ( 'yes' === settings.popup_ga_tracking_enable && settings.popup_ga_tracking_category && settings.popup_ga_tracking_label ) {
			return true;
		}

		return false;
	}

	analyticsCheck() {
		if ( 'function' === typeof ga ) {
			return 'ga';
		} else if ( 'function' === typeof gtag ) {
			return 'gtag';
		} else {
			window.console.log( 'Google Analytics code not found to track Elementor popup event!' );
			return false;
		}
	}

	getSettings() {
		return jQuery( this.event.target ).find( '[data-elementor-id="' + this.id + '"]' ).data('elementor-settings');
	}


}

class PetfeEventDispatcher {

	constructor( category, action, label, gaType ) {

		this.category = category;
		this.action = action;
		this.label = label;

		if ( 'gtag' === gaType ) {
			this.gaTagManager();
		} else {
			this.gaUniversal();
		}
	}

	gaTagManager() {
		gtag( 'event', this.action,
			{
				'event_label': this.label,
				'event_category': this.category,
				'non_interaction': true
			}
		);
	}

	gaUniversal() {
		ga('send', 'event', this.category, this.action, this.label, {
			nonInteraction: true
		});
	}

}
