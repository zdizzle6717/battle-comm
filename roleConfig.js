'use strict';

module.exports = [
	{
		'name': 'public',
		'bit': 0,
		'roleFlags': 0,
		'homeState': '/',
	},
	{
		'name': 'member',
		'bit': (1 << 0), // 1
		'roleFlags': 1,
		'homeState': '/profile',
	},
	{
		'name': 'subscriber',
		'bit': (1 << 1), // 2
		'roleFlags': 3, // subscriber, member
		'homeState': '/profile',
	},
	{
		'name': 'tourneyAdmin',
		'bit': (1 << 2), // 4
		'roleFlags': 5, // member, tourneyAdmin
		'homeState': '/profile',
	},
	{
		'name': 'eventAdmin',
		'bit': (1 << 3), // 8
		'roleFlags': 13, // member, tourneyAdmin, eventAdmin
		'homeState': '/profile',
	},
	{
		'name': 'newsContributor',
		'bit': (1 << 4), // 16
		'roleFlags': 17, // member, newsContributor
		'homeState': '/profile',
	},
	{
		'name': 'venueAdmin',
		'bit': (1 << 5), // 32
		'roleFlags': 45, // member, tourneyAdmin, eventAdmin, venueAdmin
		'homeState': '/admin',
	},
	{
		'name': 'clubAdmin',
		'bit': (1 << 6), // 64
		'roleFlags': 65, // member, clubAdmin
		'homeState': '/admin',
	},
	{
		'name': 'systemAdmin',
		'bit': (1 << 7), // 128
		'roleFlags': 255, // member, subscriber, tourneyAdmin, eventAdmin, newsContributor, venueAdmin, clubAdmin, systemAdmin
		'homeState': '/admin',
	},
];
