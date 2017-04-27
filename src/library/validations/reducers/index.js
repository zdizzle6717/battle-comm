'use strict';

import FormConstants from '../constants/FormConstants';

const _setInput = (state, input) => {
	if (!input.formName) {
		throw new Error('formsReducer.js: Input has no form property');
  }
	let _forms = Object.assign({}, state);
	_forms[input.formName] = _forms[input.formName] ? _forms[input.formName] : {'inputs': [], 'isValid': false};
	let index = _forms[input.formName].inputs.findIndex((_input) => _input.name === input.name);
	if (index !== -1) {
		_forms[input.formName].inputs[index] = input;
		return _validateForm(_forms, input.formName);
	} else {
		_forms[input.formName].inputs.push(input);
		return _validateForm(_forms, input.formName);
	}
};

const _removeInput = (state, input) => {
	let _forms = Object.assign({}, state);
	if (_forms[input.formName]) {
		let index = _forms[input.formName].inputs.findIndex((_input) => _input.name === input.name);
		if (index !== -1) {
			_forms[input.formName].inputs.splice(index, 1);
			return _validateForm(_forms, input.formName);
		}
	}
	return _forms;
};

const _validateForm = (forms, formName) => {
	if (!forms[formName]) {
		throw new Error('Validation Form Reducer: Form to validate was not found in array of forms.');
	}
  forms[formName].isValid = !forms[formName].inputs.some((input) => {
		return input.valid === false;
	});

	return forms;
};

const _removeForm = (state, formName) => {
	let _forms = Object.assign({}, state);
	delete _forms[formName];
	return _forms;
};

const forms = (state = {}, action) => {
	switch (action.type) {
		case FormConstants.ADD_INPUT:
			return _setInput(state, action.data);
		case FormConstants.REMOVE_INPUT:
			return _removeInput(state, action.data);
		case FormConstants.RESET_FORM:
			return _removeForm(state, action.data);
		case FormConstants.RESET_ALL_FORMS:
			return {};
		default:
			return state;
	}
};

export {
	forms
};
