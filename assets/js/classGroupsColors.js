class GroupsColors {

	/**
	 * Constructor of my class
	 * @param {*} name_group_colors 
	 * @param {*} url 
	 * @param {*} id_group_color 
	 */
	constructor(name_group_colors, url = "pleaseChange.php", id_group_color) {
		this.name_group_colors = name_group_colors;
		this.url = url;
		this.id_group_color = id_group_color;
	}

	/**
	 * Méthod for create an group of colors
	 */
	create() {
		let result = send_post(this, this.url);
		return result;
	}

	/**
	 * Method for update an group of colors
	 */
	update() {
		let result = send_post(this, this.url);
		return result;
	}

	/**
	 * Method for load informations of an group of colors
	 */

	load() {
		let result = send_post(this, this.url);
		return result;
	}

	getName() {
		return this.name_group_colors;
	}

	getUrl() {
		return this.url;
	}

	getId() {
		return this.id_group_color;
	}


	// =======================================================================//
	// !                     Start methods setters                           //
	// ======================================================================//

	/**
	 * 
	 * @param {*} name 
	 */
	setName(name) {
		this.name_group_colors = name;
	}

	/**
	 * 
	 * @param {*} url 
	 */
	setUrl(url) {
		this.url = url;
	}

	/**
	 * 
	 * @param {*} id_group_color 
	 */
	setId(id_group_color) {
		this.id_group_color = id_group_color;
	}


}
