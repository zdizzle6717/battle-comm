'use strict';

module.exports = [
	{
		'name': 'public',
		'roleFlags': 0,
		'homeState': '/',
	},
	{
		'name': 'member',
		'roleFlags': 1,
		'homeState': '/profile',
	},
	{
		'name': 'subscriber',
		'roleFlags': 3, // subscriber, member
		'homeState': '/profile',
	},
	{
		'name': 'tourneyAdmin',
		'roleFlags': 5, // member, tourneyAdmin
		'homeState': '/profile',
	},
	{
		'name': 'eventAdmin',
		'roleFlags': 13, // member, tourneyAdmin, eventAdmin
		'homeState': '/profile',
	},
	{
		'name': 'newsContributor',
		'roleFlags': 17, // member, newsContributor
		'homeState': '/profile',
	},
	{
		'name': 'venueAdmin',
		'roleFlags': 45, // member, tourneyAdmin, eventAdmin, venueAdmin
		'homeState': '/admin',
	},
	{
		'name': 'clubAdmin',
		'roleFlags': 65, // member, clubAdmin
		'homeState': '/admin',
	},
	{
		'name': 'systemAdmin',
		'roleFlags': 127, // member, subscriber, tourneyAdmin, eventAdmin, newsContributor, venueAdmin, clubAdmin, systemAdmin
		'homeState': '/admin',
	},
];
