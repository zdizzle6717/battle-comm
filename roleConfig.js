'use strict';

module.exports = [
	{
		'name': 'public',
		'baseBit': 0,
		'roleFlags': 0,
		'homeState': '/',
	},
	{
		'name': 'member',
		'baseBit': (1 << 0), // 1
		'roleFlags': 1,
		'homeState': '/players/dashboard',
	},
	{
		'name': 'subscriber',
		'baseBit': (1 << 1), // 2
		'roleFlags': 3, // subscriber, member
		'homeState': '/players/dashboard',
	},
	{
		'name': 'tourneyAdmin',
		'baseBit': (1 << 2), // 4
		'roleFlags': 5, // member, tourneyAdmin
		'homeState': '/players/dashboard',
	},
	{
		'name': 'eventAdmin',
		'baseBit': (1 << 3), // 8
		'roleFlags': 13, // member, tourneyAdmin, eventAdmin
		'homeState': '/admin',
	},
	{
		'name': 'eventAdminSubscriber',
		'baseBit': (1 << 4), // 16
		'roleFlags': 31, // member, subscriber, tourneyAdmin, eventAdmin
		'homeState': '/admin',
	},
	{
		'name': 'newsContributor',
		'baseBit': (1 << 5), // 32
		'roleFlags': 33, // member, newsContributor
		'homeState': '/players/dashboard',
	},
	{
		'name': 'venueAdmin',
		'baseBit': (1 << 6), // 64
		'roleFlags': 77, // member, tourneyAdmin, eventAdmin, venueAdmin
		'homeState': '/admin',
	},
	{
		'name': 'clubAdmin',
		'baseBit': (1 << 7), // 128
		'roleFlags': 257, // member, clubAdmin
		'homeState': '/admin',
	},
	{
		'name': 'systemAdmin',
		'baseBit': (1 << 8), // 256
		'roleFlags': 495, // member, subscriber, tourneyAdmin, eventAdmin, newsContributor, venueAdmin, clubAdmin, systemAdmin
		'homeState': '/admin',
	},
];
