'use strict';

let manufacturers = [{
    "id": "mnu000",
    "searchValue": "",
    "name": "Show All...",
    "gameSystem": []
}, {
    "id": "mnu901",
    "searchValue": "mnu901",
    "name": "Miscellaneous",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Chess",
        "searchValue": "mnu901CHESS"
    }, {
        "name": "DUST Tactics",
        "searchValue": "mnu901DUST"
    }, {
        "name": "Guildball",
        "searchValue": "mnu901GUILD"
    }, {
        "name": "Batman the Miniatures Game",
        "searchValue": "mnu901BATMAN"
    }]
}, {
    "id": "mnu902",
    "searchValue": "mnu902",
    "name": "Battlefront Miniatures",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Flames of War",
        "searchValue": "mnu902FLAMES"
    }]
}, {
    "id": "mnu903",
    "searchValue": "mnu903",
    "name": "Cipher Studios",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Hellderado",
        "searchValue": "mnu903HELDER"
    }]
}, {
    "id": "mnu904",
    "searchValue": "mnu904",
    "name": "Cool Mini or Not",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Wrath of King",
        "searchValue": "mnu904WRATH"
    }]
}, {
    "id": "mnu905",
    "searchValue": "mnu905",
    "name": "Corvus Belli",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Infinity",
        "searchValue": "mnu905INFIN"
    }]
}, {
    "id": "mnu906",
    "searchValue": "mnu906",
    "name": "Dark Age Miniatures",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Dark Age",
        "searchValue": "mnu906DARKA"
    }]
}, {
    "id": "mnu907",
    "searchValue": "mnu907",
    "name": "Dream Pod 9",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Heavy Gear",
        "searchValue": "mnu907HEAVY"
    }]
}, {
    "id": "mnu908",
    "searchValue": "mnu908",
    "name": "Fantasy Flight Games",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Star Wars Armada",
        "searchValue": "mnu908STARWA"
    }, {
        "name": "Call of Cthulhu: The Card Game",
        "searchValue": "mnu908CTHUL"
    }, {
        "name": "Game of Thrones: The Card Game",
        "searchValue": "mnu908GOTCG"
    }, {
        "name": "Netrunner",
        "searchValue": "mnu908NETRUN"
    }, {
        "name": "Star Wars Imperial Assault",
        "searchValue": "mnu908STARIA"
    }, {
        "name": "Star Wars: The Card Game",
        "searchValue": "mnu908STARTCG"
    }, {
        "name": "Star Wars X-Wing",
        "searchValue": "mnu908STARXW"
    }, {
        "name": "Warhammer 40K: Conquest",
        "searchValue": "mnu908WAR40K"
    }, {
        "name": "Warhammer: Invasion",
        "searchValue": "mnu908WARINV"
    }]
}, {
    "id": "mnu909",
    "searchValue": "mnu909",
    "name": "Forge World (Games Workshop)",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Horus Heresy",
        "searchValue": "mnu909HORHE"
    }]
}, {
    "id": "mnu910",
    "searchValue": "mnu910",
    "name": "Games Workshop",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Warhammer 40K",
        "searchValue": "mnu910WAR40K"
    }, {
        "name": "The Hobbit/TLOTR",
        "searchValue": "mnu910HOBBIT"
    }, {
        "name": "Blood Bowl",
        "searchValue": "mnu910BLOOD"
    }, {
        "name": "Age of Sigmar",
        "searchValue": "mnu910AOSIG"
    }, {
        "name": "Epic 40K",
        "searchValue": "mnu910EPIC40K"
    }, {
        "name": "Battle Fleet Gothic",
        "searchValue": "mnu910BATFGOT"
    }, {
        "name": "Necromunda",
        "searchValue": "mnu910NECROM"
    }]
}, {
    "id": "mnu911",
    "searchValue": "mnu911",
    "name": "GCT Studios",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Bushido",
        "searchValue": "mnu911BUSHID"
    }]
}, {
    "id": "mnu912",
    "searchValue": "mnu912",
    "name": "Hawk Wargames",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Drop Zone Commander",
        "searchValue": "mnu912DZCOM"
    }, {
        "name": "Drop Fleet Commander",
        "searchValue": "mnu912DFCOM"
    }]
}, {
    "id": "mnu913",
    "searchValue": "mnu913",
    "name": "Mantic",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Dead Zone",
        "searchValue": "mnu913DEADZO"
    }, {
        "name": "Dread Ball",
        "searchValue": "mnu913DREAD"
    }, {
        "name": "Kings of War",
        "searchValue": "mnu913KINGSOW"
    }, {
        "name": "Warpath",
        "searchValue": "mnu913WARPA"
    }]
}, {
    "id": "mnu914",
    "searchValue": "mnu914",
    "name": "Ninja Division",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Relic Knights",
        "searchValue": "mnu914RELIC"
    }]
}, {
    "id": "mnu915",
    "searchValue": "mnu915",
    "name": "Outlaw Games",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Wild West Exodus",
        "searchValue": "mnu915WILDW"
    }]
}, {
    "id": "mnu916",
    "searchValue": "mnu916",
    "name": "Pallaedium Books",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Robotech Tactics",
        "searchValue": "mnu916ROBOT"
    }]
}, {
    "id": "mnu917",
    "searchValue": "mnu917",
    "name": "Privateer Press",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Warmachine/Hordes",
        "searchValue": "mnu917WARHOR"
    }]
}, {
    "id": "mnu918",
    "searchValue": "mnu918",
    "name": "Prodos",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Warzone",
        "searchValue": "mnu918WARZO"
    }]
}, {
    "id": "mnu919",
    "searchValue": "mnu919",
    "name": "Rocket Games",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Last Saga",
        "searchValue": "mnu919LASTSA"
    }]
}, {
    "id": "mnu920",
    "searchValue": "mnu920",
    "name": "Spartan Games",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Dystopian Legions",
        "searchValue": "mnu920DYSLE"
    }, {
        "name": "Dystopian Wars",
        "searchValue": "mnu920DYSWA"
    }, {
        "name": "Firestorm Armada",
        "searchValue": "mnu920FIREARM"
    }, {
        "name": "Firestorm Planetfall",
        "searchValue": "mnu920FIREPL"
    }, {
        "name": "Armoured Clash",
        "searchValue": "mnu920ARMCLA"
    }, {
        "name": "Halo Fleet Battles",
        "searchValue": "mnu920HALOFB"
    }]
}, {
    "id": "mnu921",
    "searchValue": "mnu921",
    "name": "Spiral Arm Studios",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Maelstrom's Edge",
        "searchValue": "mnu921MAELED"
    }]
}, {
    "id": "mnu922",
    "searchValue": "mnu922",
    "name": "Tomahawk Studios",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Saga",
        "searchValue": "mnu922SAGA"
    }]
}, {
    "id": "mnu923",
    "searchValue": "mnu923",
    "name": "Warlord Games",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Black Powder",
        "searchValue": "mnu923BLACK"
    }, {
        "name": "Bold Action",
        "searchValue": "mnu923BOLTA"
    }, {
        "name": "Hail Caesar",
        "searchValue": "mnu923HAILC"
    }, {
        "name": "Pike & Shotte",
        "searchValue": "mnu923PIKESH"
    }, {
        "name": "Beyond the Gates of Antares",
        "searchValue": "mnu923BTGOA"
    }]
}, {
    "id": "mnu924",
    "searchValue": "mnu924",
    "name": "Wizards of the Coast (Hasbro)",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Magic The Gathering",
        "searchValue": "mnu924MAGTG"
    }]
}, {
    "id": "mnu925",
    "searchValue": "mnu925",
    "name": "Wizkids",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "D&D Attack Wing",
        "searchValue": "mnu925DDAWI"
    }, {
        "name": "Hero Clicks",
        "searchValue": "mnu925HEROC"
    }, {
        "name": "Star Trek Attack Wing",
        "searchValue": "mnu925STARTAW"
    }]
}, {
    "id": "mnu926",
    "searchValue": "mnu926",
    "name": "Wyrd",
    "gameSystem": [{
        "name": "Show All Systems...",
        "searchValue": ""
    }, {
        "name": "Malifaux",
        "searchValue": "mnu926MALIF"
    }]
}]


module.exports = manufacturers;
