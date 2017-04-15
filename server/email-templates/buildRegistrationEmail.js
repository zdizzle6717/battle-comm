'use strict';

import memberRegistration from './memberRegistration';
import subscriberRegistration from './subscriberRegistration';
import tourneyAdminRegistration from './tourneyAdminRegistration';
import eventAdminRegistration from './eventAdminRegistration';
import newsContributorRegistration from './newsContributorRegistration';
import venueAdminRegistration from './venueAdminRegistration';
import clubAdminRegistration from './clubAdminRegistration';
import systemAdminRegistration from './systemAdminRegistration';

function buildRegistrationEmail(role, user) {
	switch (role) {
		case 'member':
			return memberRegistration(user);
		case 'subscriber':
			return subscriberRegistration(user);
		case 'tourneyAdmin':
			return tourneyAdminRegistration(user);
		case 'eventAdmin':
			return eventAdminRegistration(user);
		case 'newsContributor':
			return newsContributorRegistration(user);
		case 'venueAdmin':
			return venueAdminRegistration(user);
		case 'clubAdmin':
			return clubAdminRegistration(user);
		case 'systemAdmin':
			return systemAdminRegistration(user);
		default:
			throw new Error('No e-mail template exists for the supplied user role!');
	}
}

export default buildRegistrationEmail;
