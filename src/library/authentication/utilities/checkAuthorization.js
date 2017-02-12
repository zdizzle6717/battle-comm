'use strict';

import rolesConfig from '../../../constants/rolesConfig';

const checkAuthorization = (accessControl, user) => {
	let userFlags = user.roleFlags || 0;
	let accessFlags = 0;
	accessControl.forEach((roleName) => {
		rolesConfig.forEach((config) => {
			if (config.name === roleName) {
				accessFlags += config.roleFlags;
			}
		});
	});

	let hasFlags = (flags, mask) => {
		flags = parseInt(flags, 10);
		mask = parseInt(mask, 10);

		return (mask & flags) === mask;
	};

	let accessGranted = hasFlags(userFlags, accessFlags) && userFlags !== 0;

	return accessGranted;
}

export default checkAuthorization;
