class Customers {

	/**
	 * Method constructor of the class customers
	 * @param {*} name_customers 
	 * @param {*} first_name_customers 
	 * @param {*} mobil_phone_number_customers 
	 * @param {*} phone_number_customers 
	 * @param {*} email_customers 
	 * @param {*} address_customers 
	 * @param {*} code_postal_customers 
	 * @param {*} city_customers 
	 * @param {*} name_group_for_customers 
	 * @param {*} url 
	 */
	constructor(name_customers, first_name_customers, mobil_phone_number_customers, phone_number_customers, email_customers, address_customers, code_postal_customers, city_customers, name_group_for_customers, url) {
		this.name_customers = name_customers;
		this.first_name_customers = first_name_customers;
		this.mobil_phone_number_customers = mobil_phone_number_customers;
		this.phone_number_customers = phone_number_customers;
		this.email_customers = email_customers;
		this.address_customers = address_customers;
		this.code_postal_customers = code_postal_customers;
		this.city_customers = city_customers;
		this.name_group_for_customers = name_group_for_customers;
		this.url = url;
	}

	// =======================================================================//
	// !                     Start methods setters                           //
	// ======================================================================//

	/**
	 * 
	 * @param {*} name 
	 */
	setNameCustomers(name) {
		this.name_customers = name;
	}

	/**
	 * 
	 * @param {*} firstname 
	 */
	setFirstNameCustomers(firstname) {
		this.first_name_customers = firstname;
	}

	/**
	 * 
	 * @param {*} mobile 
	 */
	setMobilPhoneNumberCustomers(mobile) {
		this.mobil_phone_number_customers = mobile;
	}

	/**
	 * 
	 * @param {*} phone 
	 */
	setPhoneNumberCustomers(phone) {
		this.phone_number_customers = phone;
	}

	/**
	 * 
	 * @param {*} mail 
	 */
	setEmailCustomers(mail) {
		this.email_customers = mail;
	}

	/**
	 * 
	 * @param {*} address 
	 */
	setAddressCustomers(address) {
		this.address_customers = address;
	}

	/**
	 * 
	 * @param {*} postal 
	 */
	setCodePostalCustomers(postal) {
		this.code_postal_customers = postal;
	}

	/**
	 * 
	 */
	setCityCustomers(city) {
		this.city_customers = city;
	}

	/**
	 * 
	 * @param {*} group 
	 */
	setNameGroupCustomers(group) {
		this.name_group_for_customers = group;
	}

	/**
	 * 
	 * @param {*} url 
	 */
	setUrl(url) {
		this.url = url;
	}

	// =======================================================================//
	// !                     Start methods getters                           //
	// ======================================================================//

	getNameCustomers() {
		return this.name_customers;
	}

	getFirstNameCustomers() {
		return this.first_name_customers;
	}

	getMobilPhoneNumberCustomers() {
		return this.mobil_phone_number_customers;
	}

	getPhoneNumberCustomers() {
		return this.phone_number_customers;
	}

	getEmailCustomers() {
		return this.email_customers;
	}

	getAddressCustomers() {
		return this.address_customers;
	}

	getCodePostalCustomers() {
		return this.code_postal_customers;
	}

	getCityCustomers() {
		return this.city_customers;
	}

	getNameGroupCustomers() {
		return this.name_group_for_customers;
	}

	getUrl() {
		return this.url;
	}








}
