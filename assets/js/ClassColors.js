class Colors {

	/**
	 * Constructor of my class
	 * @param {*} color_name 
	 * @param {*} color_code 
	 * @param {*} name_group_for_color 
	 * @param {*} url 
	 * @param {*} id_color
	 */

	constructor(color_name, color_code, name_group_for_color, url = "pleaseChange.php", id) {
		this.color_name = color_name;
		this.color_code = color_code;
		this.name_group_for_color = name_group_for_color;
		this.url = url;
		this.id_color = id;
	}

	/**
	 * Method for create an color
	 */
	create() {
		let result = send_post(this, this.url);
		return result;
	}

	/**
	 * Method for update an color
	 */
	update() {
		let result = send_post(this, this.url);
		return result;
	}

	/**
	 * Method for load informations of colors
	 */
	load() {
		let result = send_post(this, this.url);
		return result;
	}


	// =======================================================================//
	// !                     Start methods getters                           //
	// ======================================================================//

	getName() {
		return this.color_name;
	}

	getCode() {
		return this.color_code;
	}

	getGroup() {
		return this.name_group_for_color;
	}

	// =======================================================================//
	// !                     Start methods setters                           //
	// ======================================================================//

	/**
	 * Method setters for add an name
	 * @param {*} name 
	 */
	setName(name) {
		this.color_name = name;
	}


	/**
	 * Method setters for add an code colors
	 * @param {*} code 
	 */
	setCode(code) {
		this.color_code = code;
	}

	/**
	 * Method setters for add the group
	 * @param {*} group 
	 */

	setGroup(group) {
		this.name_group_for_color = group;
	}

	/**
	 * Method setters for add the url
	 * @param {*} url 
	 */
	setUrl(url) {
		this.url = url;
	}

	/**
	 * Method setters for add id
	 * @param {*} id 
	 */
	setId(id) {
		this.id_color = id;
	}

}
