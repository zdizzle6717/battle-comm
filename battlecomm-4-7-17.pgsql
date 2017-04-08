--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.4
-- Dumped by pg_dump version 9.5.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: FactionRankings; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "FactionRankings" (
    id integer NOT NULL,
    "totalWins" integer DEFAULT 0,
    "totalLosses" integer DEFAULT 0,
    "totalDraws" integer DEFAULT 0,
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "FactionId" integer,
    "GameSystemRankingId" integer
);


ALTER TABLE "FactionRankings" OWNER TO bcadmin;

--
-- Name: FactionRankings_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "FactionRankings_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "FactionRankings_id_seq" OWNER TO bcadmin;

--
-- Name: FactionRankings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "FactionRankings_id_seq" OWNED BY "FactionRankings".id;


--
-- Name: Factions; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "Factions" (
    id integer NOT NULL,
    name character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "GameSystemId" integer,
    "UserRankingId" integer
);


ALTER TABLE "Factions" OWNER TO bcadmin;

--
-- Name: Factions_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "Factions_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Factions_id_seq" OWNER TO bcadmin;

--
-- Name: Factions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "Factions_id_seq" OWNED BY "Factions".id;


--
-- Name: GameSystemRankings; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "GameSystemRankings" (
    id integer NOT NULL,
    "totalWins" integer DEFAULT 0,
    "totalLosses" integer DEFAULT 0,
    "totalDraws" integer DEFAULT 0,
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "GameSystemId" integer,
    "UserId" integer
);


ALTER TABLE "GameSystemRankings" OWNER TO bcadmin;

--
-- Name: GameSystemRankings_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "GameSystemRankings_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "GameSystemRankings_id_seq" OWNER TO bcadmin;

--
-- Name: GameSystemRankings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "GameSystemRankings_id_seq" OWNED BY "GameSystemRankings".id;


--
-- Name: GameSystems; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "GameSystems" (
    id integer NOT NULL,
    name character varying(255),
    description text,
    "searchKey" character varying(255),
    photo character varying(255),
    url character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserRankingId" integer,
    "ManufacturerId" integer
);


ALTER TABLE "GameSystems" OWNER TO bcadmin;

--
-- Name: GameSystems_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "GameSystems_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "GameSystems_id_seq" OWNER TO bcadmin;

--
-- Name: GameSystems_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "GameSystems_id_seq" OWNED BY "GameSystems".id;


--
-- Name: Manufacturers; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "Manufacturers" (
    id integer NOT NULL,
    name character varying(255),
    "searchKey" character varying(255),
    description text,
    photo character varying(255),
    url character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL
);


ALTER TABLE "Manufacturers" OWNER TO bcadmin;

--
-- Name: Manufacturers_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "Manufacturers_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Manufacturers_id_seq" OWNER TO bcadmin;

--
-- Name: Manufacturers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "Manufacturers_id_seq" OWNED BY "Manufacturers".id;


--
-- Name: NewsPosts; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "NewsPosts" (
    id integer NOT NULL,
    title character varying(255),
    image character varying(255),
    callout text,
    body text,
    published boolean,
    featured boolean,
    tags character varying(255),
    "manufacturerId" character varying(255),
    "gameSystem" character varying(255),
    category character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer,
    "ManufacturerId" integer,
    "FactionId" integer,
    "GameSystemId" integer
);


ALTER TABLE "NewsPosts" OWNER TO bcadmin;

--
-- Name: NewsPosts_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "NewsPosts_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "NewsPosts_id_seq" OWNER TO bcadmin;

--
-- Name: NewsPosts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "NewsPosts_id_seq" OWNED BY "NewsPosts".id;


--
-- Name: ProductOrders; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "ProductOrders" (
    id integer NOT NULL,
    status character varying(255),
    "orderDetails" character varying(255),
    "orderTotal" integer,
    "customerFullName" character varying(255),
    "customerEmail" character varying(255),
    phone character varying(255),
    "shippingStreet" character varying(255),
    "shippingAppartment" character varying(255),
    "shippingCity" character varying(255),
    "shippingState" character varying(255),
    "shippingZip" character varying(255),
    "shippingCountry" character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer
);


ALTER TABLE "ProductOrders" OWNER TO bcadmin;

--
-- Name: ProductOrders_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "ProductOrders_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "ProductOrders_id_seq" OWNER TO bcadmin;

--
-- Name: ProductOrders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "ProductOrders_id_seq" OWNED BY "ProductOrders".id;


--
-- Name: Products; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "Products" (
    id integer NOT NULL,
    "SKU" character varying(255),
    name character varying(255),
    price integer,
    description text,
    "manufacturerId" character varying(255),
    "gameSystem" character varying(255),
    color character varying(255),
    tags character varying(255),
    category character varying(255),
    "stockQty" integer,
    "inStock" boolean,
    "filterVal" character varying(255) DEFAULT 'showit'::character varying,
    "displayStatus" boolean,
    featured boolean,
    new boolean,
    "onSale" boolean,
    "imgAlt" character varying(255),
    "imgOneFront" character varying(255),
    "imgOneBack" character varying(255),
    "imgTwoFront" character varying(255),
    "imgTwoBack" character varying(255),
    "imgThreeFront" character varying(255),
    "imgThreeBack" character varying(255),
    "imgFourFront" character varying(255),
    "imgFourBack" character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "ManufacturerId" integer,
    "FactionId" integer,
    "GameSystemId" integer
);


ALTER TABLE "Products" OWNER TO bcadmin;

--
-- Name: Products_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "Products_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Products_id_seq" OWNER TO bcadmin;

--
-- Name: Products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "Products_id_seq" OWNED BY "Products".id;


--
-- Name: UserAchievements; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "UserAchievements" (
    id integer NOT NULL,
    title character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer
);


ALTER TABLE "UserAchievements" OWNER TO bcadmin;

--
-- Name: UserAchievements_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "UserAchievements_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "UserAchievements_id_seq" OWNER TO bcadmin;

--
-- Name: UserAchievements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "UserAchievements_id_seq" OWNED BY "UserAchievements".id;


--
-- Name: UserMessages; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "UserMessages" (
    id integer NOT NULL,
    status character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer
);


ALTER TABLE "UserMessages" OWNER TO bcadmin;

--
-- Name: UserMessages_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "UserMessages_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "UserMessages_id_seq" OWNER TO bcadmin;

--
-- Name: UserMessages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "UserMessages_id_seq" OWNED BY "UserMessages".id;


--
-- Name: UserNotifications; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "UserNotifications" (
    id integer NOT NULL,
    type character varying(255),
    status character varying(255) DEFAULT 'unRead'::character varying,
    "fromId" integer,
    "fromName" character varying(255),
    "fromUsername" character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer
);


ALTER TABLE "UserNotifications" OWNER TO bcadmin;

--
-- Name: UserNotifications_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "UserNotifications_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "UserNotifications_id_seq" OWNER TO bcadmin;

--
-- Name: UserNotifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "UserNotifications_id_seq" OWNED BY "UserNotifications".id;


--
-- Name: UserPhotos; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "UserPhotos" (
    id integer NOT NULL,
    url character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer
);


ALTER TABLE "UserPhotos" OWNER TO bcadmin;

--
-- Name: UserPhotos_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "UserPhotos_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "UserPhotos_id_seq" OWNER TO bcadmin;

--
-- Name: UserPhotos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "UserPhotos_id_seq" OWNED BY "UserPhotos".id;


--
-- Name: UserRankings; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "UserRankings" (
    id integer NOT NULL,
    "totalWins" integer DEFAULT 0,
    "totalLosses" integer DEFAULT 0,
    "totalDraws" integer DEFAULT 0,
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "FactionId" integer,
    "GameSystemId" integer,
    "UserId" integer
);


ALTER TABLE "UserRankings" OWNER TO bcadmin;

--
-- Name: UserRankings_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "UserRankings_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "UserRankings_id_seq" OWNER TO bcadmin;

--
-- Name: UserRankings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "UserRankings_id_seq" OWNED BY "UserRankings".id;


--
-- Name: Users; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "Users" (
    id integer NOT NULL,
    email character varying(255),
    password character varying(255),
    "firstName" character varying(255),
    "lastName" character varying(255),
    member boolean DEFAULT false,
    "tourneyAdmin" boolean DEFAULT false,
    "eventAdmin" boolean DEFAULT false,
    "newsContributor" boolean DEFAULT false,
    "venueAdmin" boolean DEFAULT false,
    "clubAdmin" boolean DEFAULT false,
    "systemAdmin" boolean DEFAULT false,
    username character varying(255),
    club integer,
    "mainPhone" character varying(255),
    "mobilePhone" character varying(255),
    "streetAddress" character varying(255),
    "aptSuite" character varying(255),
    city character varying(255),
    state character varying(255),
    zip character varying(255),
    dob timestamp with time zone,
    bio text,
    facebook character varying(255),
    twitter character varying(255),
    instagram character varying(255),
    "googlePlus" character varying(255),
    youtube character varying(255),
    twitch character varying(255),
    website character varying(255),
    "rewardPoints" integer,
    visibility character varying(255),
    "shareContact" character varying(255),
    "shareName" character varying(255),
    "shareStatus" character varying(255),
    newsletter character varying(255),
    marketing character varying(255),
    sms character varying(255),
    "allowPlay" character varying(255),
    icon character varying(255) DEFAULT 'profile_image_default.png'::character varying,
    "eloRanking" integer DEFAULT 0,
    "accountActive" character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer,
    subscriber boolean DEFAULT false
);


ALTER TABLE "Users" OWNER TO bcadmin;

--
-- Name: Users_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "Users_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Users_id_seq" OWNER TO bcadmin;

--
-- Name: Users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "Users_id_seq" OWNED BY "Users".id;


--
-- Name: userHasFriends; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "userHasFriends" (
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer NOT NULL,
    "FriendId" integer NOT NULL
);


ALTER TABLE "userHasFriends" OWNER TO bcadmin;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "FactionRankings" ALTER COLUMN id SET DEFAULT nextval('"FactionRankings_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Factions" ALTER COLUMN id SET DEFAULT nextval('"Factions_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "GameSystemRankings" ALTER COLUMN id SET DEFAULT nextval('"GameSystemRankings_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "GameSystems" ALTER COLUMN id SET DEFAULT nextval('"GameSystems_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Manufacturers" ALTER COLUMN id SET DEFAULT nextval('"Manufacturers_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "NewsPosts" ALTER COLUMN id SET DEFAULT nextval('"NewsPosts_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "ProductOrders" ALTER COLUMN id SET DEFAULT nextval('"ProductOrders_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Products" ALTER COLUMN id SET DEFAULT nextval('"Products_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserAchievements" ALTER COLUMN id SET DEFAULT nextval('"UserAchievements_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserMessages" ALTER COLUMN id SET DEFAULT nextval('"UserMessages_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserNotifications" ALTER COLUMN id SET DEFAULT nextval('"UserNotifications_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserPhotos" ALTER COLUMN id SET DEFAULT nextval('"UserPhotos_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserRankings" ALTER COLUMN id SET DEFAULT nextval('"UserRankings_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Users" ALTER COLUMN id SET DEFAULT nextval('"Users_id_seq"'::regclass);


--
-- Data for Name: FactionRankings; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "FactionRankings" (id, "totalWins", "totalLosses", "totalDraws", "createdAt", "updatedAt", "FactionId", "GameSystemRankingId") FROM stdin;
6	7	0	0	2016-10-21 16:45:13.587+00	2016-10-21 16:45:13.587+00	22	4
4	11	1	2	2016-10-21 16:44:37.534+00	2016-10-21 16:51:00.872+00	20	3
5	15	0	0	2016-10-21 16:44:54.844+00	2016-10-21 16:52:57.513+00	21	3
1	0	0	0	2016-10-20 22:14:19.381+00	2016-10-22 00:57:41.467+00	22	1
2	45	0	3	2016-10-20 22:29:11.585+00	2016-10-25 14:51:56.863+00	20	2
3	3	2	1	2016-10-20 22:29:33.665+00	2016-10-25 14:52:19.178+00	21	2
7	1	0	0	2016-11-02 23:53:15.657+00	2016-11-02 23:53:15.657+00	23	5
8	0	1	0	2016-11-02 23:54:33.826+00	2016-11-02 23:54:33.826+00	25	6
9	1	0	0	2016-11-05 01:44:33.362+00	2016-11-05 01:44:33.362+00	70	7
\.


--
-- Name: FactionRankings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"FactionRankings_id_seq"', 9, true);


--
-- Data for Name: Factions; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "Factions" (id, name, "createdAt", "updatedAt", "GameSystemId", "UserRankingId") FROM stdin;
20	Space Marines: Iron Hands	2016-10-19 00:37:08.631+00	2016-10-19 00:37:08.631+00	22	\N
21	Craftworld Eldar	2016-10-19 00:41:29.675+00	2016-10-19 00:41:29.675+00	22	\N
22	Gremlins	2016-10-19 01:11:42.797+00	2016-10-19 01:11:42.797+00	69	\N
23	America	2016-10-25 15:09:58.463+00	2016-10-25 15:09:58.463+00	61	\N
24	British	2016-10-25 15:10:17.746+00	2016-10-25 15:10:17.746+00	61	\N
25	Germany	2016-10-25 15:10:27.833+00	2016-10-25 15:10:27.833+00	61	\N
26	Italy	2016-10-25 15:10:43.201+00	2016-10-25 15:10:43.201+00	61	\N
27	Russia	2016-10-25 15:11:05.416+00	2016-10-25 15:11:05.416+00	61	\N
28	Japan	2016-10-25 15:11:18.403+00	2016-10-25 15:11:18.403+00	61	\N
29	France	2016-10-25 15:11:30.811+00	2016-10-25 15:11:30.811+00	61	\N
30	Red	2016-10-25 15:12:25.353+00	2016-10-25 15:12:25.353+00	65	\N
31	Green	2016-10-25 15:12:32.286+00	2016-10-25 15:12:32.286+00	65	\N
32	Blue	2016-10-25 15:12:39.913+00	2016-10-25 15:12:39.913+00	65	\N
33	Black	2016-10-25 15:12:49.789+00	2016-10-25 15:12:49.789+00	65	\N
34	White	2016-10-25 15:12:58.073+00	2016-10-25 15:12:58.073+00	65	\N
35	Black	2016-10-25 15:13:57.133+00	2016-10-25 15:13:57.133+00	2	\N
36	White	2016-10-25 15:14:04.535+00	2016-10-25 15:14:04.535+00	2	\N
37	Empire	2016-10-25 15:14:28.232+00	2016-10-25 15:14:28.232+00	12	\N
38	Rebels	2016-10-25 15:14:37.76+00	2016-10-25 15:14:37.76+00	12	\N
39	Scoundrels	2016-10-25 15:14:48.632+00	2016-10-25 15:14:48.632+00	12	\N
40	Empire	2016-10-25 15:15:16.957+00	2016-10-25 15:15:16.957+00	18	\N
41	Rebels	2016-10-25 15:15:26.111+00	2016-10-25 15:15:26.111+00	18	\N
42	Scoundrels	2016-10-25 15:15:35.962+00	2016-10-25 15:15:35.962+00	18	\N
43	Ultramarines	2016-10-25 15:16:15.266+00	2016-10-25 15:16:15.266+00	21	\N
44	Imperial Fists	2016-10-25 15:16:27.543+00	2016-10-25 15:16:27.543+00	21	\N
45	Thousand Sons	2016-10-25 15:16:41.603+00	2016-10-25 15:16:41.603+00	21	\N
46	Alpha Legion	2016-10-25 15:16:53.644+00	2016-10-25 15:16:53.644+00	21	\N
47	Sons of Horus	2016-10-25 15:17:06.129+00	2016-10-25 15:17:06.129+00	21	\N
48	Blood Angels	2016-10-25 15:17:24.579+00	2016-10-25 15:17:24.579+00	21	\N
49	White Scars	2016-10-25 15:17:36.722+00	2016-10-25 15:17:36.722+00	21	\N
50	Iron Warriors	2016-10-25 15:17:49.622+00	2016-10-25 15:17:49.622+00	21	\N
51	Iron Hands	2016-10-25 15:18:00.854+00	2016-10-25 15:18:00.854+00	21	\N
52	Emperors Children	2016-10-25 15:18:37.151+00	2016-10-25 15:18:37.151+00	21	\N
53	Death Guard	2016-10-25 15:19:07.557+00	2016-10-25 15:19:07.557+00	21	\N
54	Night Lords	2016-10-25 15:19:21.578+00	2016-10-25 15:19:21.578+00	21	\N
55	Dark Angels	2016-10-25 15:19:33.683+00	2016-10-25 15:19:33.683+00	21	\N
56	Space Wolves	2016-10-25 15:19:50.932+00	2016-10-25 15:19:50.932+00	21	\N
57	World Eaters	2016-10-25 15:20:08.481+00	2016-10-25 15:20:08.481+00	21	\N
58	Salamanders	2016-10-25 15:20:44.007+00	2016-10-25 15:20:44.007+00	21	\N
59	Word Bearers	2016-10-25 15:20:58.258+00	2016-10-25 15:20:58.258+00	21	\N
60	Raven Guard	2016-10-25 15:24:55.068+00	2016-10-25 15:24:55.068+00	21	\N
61	Space Marines: Ultramarines	2016-10-25 15:25:59.283+00	2016-10-25 15:25:59.283+00	22	\N
62	Space Marines: Blood Angels	2016-10-25 15:26:14.142+00	2016-10-25 15:26:14.142+00	22	\N
63	Space Marines: Dark Angels	2016-10-25 15:26:28.421+00	2016-10-25 15:26:28.421+00	22	\N
64	Space Marines: Iron Hands	2016-10-25 15:26:40.097+00	2016-10-25 15:26:40.097+00	22	\N
65	Space Marines: White Scars	2016-10-25 15:26:57.77+00	2016-10-25 15:26:57.77+00	22	\N
66	Space Marines: Salamanders	2016-10-25 15:27:13.095+00	2016-10-25 15:27:13.095+00	22	\N
67	Space Marines: Imperial Fists	2016-10-25 15:27:35.065+00	2016-10-25 15:27:35.065+00	22	\N
68	Space Marines: Raven Guard	2016-10-25 15:27:48.885+00	2016-10-25 15:27:48.885+00	22	\N
69	Space Marines: Space Wolves	2016-10-25 15:28:01.7+00	2016-10-25 15:28:01.7+00	22	\N
19	Test Factions	2016-10-18 22:25:47.121+00	2016-11-02 00:02:22.473+00	69	\N
70	UNSC	2016-11-05 01:38:11.59+00	2016-11-05 01:38:11.59+00	57	\N
71	Covenant	2016-11-05 01:38:30.758+00	2016-11-05 01:38:30.758+00	57	\N
\.


--
-- Name: Factions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Factions_id_seq"', 71, true);


--
-- Data for Name: GameSystemRankings; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "GameSystemRankings" (id, "totalWins", "totalLosses", "totalDraws", "createdAt", "updatedAt", "GameSystemId", "UserId") FROM stdin;
4	7	0	0	2016-10-21 16:45:13.573+00	2016-10-21 16:45:13.573+00	69	5
3	26	1	2	2016-10-21 16:44:37.514+00	2016-10-21 16:52:57.503+00	22	5
1	0	0	0	2016-10-20 22:14:19.356+00	2016-10-22 00:57:41.46+00	69	1
2	48	2	4	2016-10-20 22:29:11.559+00	2016-10-25 14:52:19.172+00	22	1
5	1	0	0	2016-11-02 23:53:15.639+00	2016-11-02 23:53:15.639+00	61	28
6	0	1	0	2016-11-02 23:54:33.811+00	2016-11-02 23:54:33.811+00	61	5
7	1	0	0	2016-11-05 01:44:33.346+00	2016-11-05 01:44:33.346+00	57	27
\.


--
-- Name: GameSystemRankings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"GameSystemRankings_id_seq"', 7, true);


--
-- Data for Name: GameSystems; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "GameSystems" (id, name, description, "searchKey", photo, url, "createdAt", "updatedAt", "UserRankingId", "ManufacturerId") FROM stdin;
1	General Table-Top	\N	mnu901Gen	\N	\N	2016-10-15 17:56:17.188+00	2016-10-15 18:24:18.122+00	\N	1
2	Chess	\N	mnu901CHESS	\N	\N	2016-10-15 18:26:28.897+00	2016-10-15 18:26:28.897+00	\N	1
3	DUST Tactics	\N	mnu901DUST	\N	\N	2016-10-15 18:27:05.929+00	2016-10-15 18:27:05.929+00	\N	1
4	Guildball	\N	mnu901GUILD	\N	\N	2016-10-15 18:28:05.737+00	2016-10-15 18:28:05.737+00	\N	1
5	Batman the Miniatures Game	\N	mnu901BATMAN	\N	\N	2016-10-15 18:28:30.475+00	2016-10-15 18:28:30.475+00	\N	1
6	Flames of War	\N	mnu902FLAMES	\N	\N	2016-10-15 18:29:03.006+00	2016-10-15 18:29:03.006+00	\N	2
7	Hellderado	\N	mnu903HELDER	\N	\N	2016-10-15 18:29:42.601+00	2016-10-15 18:29:42.601+00	\N	3
8	Wrath of Kings	\N	mnu904WRATH	\N	\N	2016-10-15 18:33:25.115+00	2016-10-15 18:33:25.115+00	\N	4
9	Infinity	\N	mnu905INFIN	\N	\N	2016-10-15 18:34:13.254+00	2016-10-15 18:34:13.254+00	\N	5
10	Dark Age	\N	mnu906DARKA	\N	\N	2016-10-15 18:34:41.004+00	2016-10-15 18:34:41.004+00	\N	6
11	Heavy Gear	\N	mnu907HEAVY	\N	\N	2016-10-15 18:35:03.388+00	2016-10-15 18:35:03.388+00	\N	7
12	Star Wars Armada	\N	mnu908STARWA	\N	\N	2016-10-15 18:35:35.306+00	2016-10-15 18:35:35.306+00	\N	8
13	Call of Cthulhu: The Card Game	\N	mnu908CTHUL	\N	\N	2016-10-15 18:36:00.297+00	2016-10-15 18:36:00.297+00	\N	8
14	Game of Thrones: The Card Game	\N	mnu908GOTCG	\N	\N	2016-10-15 18:36:29.302+00	2016-10-15 18:36:29.302+00	\N	8
15	Netrunner	\N	mnu908NETRUN	\N	\N	2016-10-15 18:36:51.884+00	2016-10-15 18:36:51.884+00	\N	8
16	Star Wars Imperial Assault	\N	mnu908STARIA	\N	\N	2016-10-15 18:37:26.913+00	2016-10-15 18:37:26.913+00	\N	8
17	Star Wars: The Card Game	\N	mnu908STARTCG	\N	\N	2016-10-15 18:37:56.23+00	2016-10-15 18:37:56.23+00	\N	8
18	Star Wars X-Wing	\N	mnu908STARXW	\N	\N	2016-10-15 18:38:19.737+00	2016-10-15 18:38:19.737+00	\N	8
20	Warhammer: Invasion	\N	mnu908WARINV	\N	\N	2016-10-15 18:39:19.686+00	2016-10-15 18:39:19.686+00	\N	8
21	Horus Heresy	\N	mnu909HORHE	\N	\N	2016-10-15 18:39:51.987+00	2016-10-15 18:39:51.987+00	\N	9
22	Warhammer 40K	\N	mnu910WAR40K	\N	\N	2016-10-15 18:40:21.449+00	2016-10-15 18:40:21.449+00	\N	10
23	The Hobbit/TLOTR	\N	mnu910HOBBIT	\N	\N	2016-10-15 18:40:46.136+00	2016-10-15 18:40:46.136+00	\N	10
24	Blood Bowl	\N	mnu910BLOOD	\N	\N	2016-10-15 18:41:10.039+00	2016-10-15 18:41:10.039+00	\N	10
25	Age of Sigmar	\N	mnu910AOSIG	\N	\N	2016-10-15 18:41:38.526+00	2016-10-15 18:41:38.526+00	\N	10
36	Epic 40K	\N	mnu910EPIC40K	\N	\N	2016-10-15 18:42:10.478+00	2016-10-15 18:42:10.478+00	\N	10
37	Battle Fleet Gothic	\N	mnu910BATFGOT	\N	\N	2016-10-15 18:42:41.72+00	2016-10-15 18:42:41.72+00	\N	10
38	Necromunda	\N	mnu910NECROM	\N	\N	2016-10-15 18:43:03.974+00	2016-10-15 18:43:03.974+00	\N	10
39	Bushido	\N	mnu911BUSHID	\N	\N	2016-10-15 18:43:28.054+00	2016-10-15 18:43:28.054+00	\N	11
40	Drop Zone Commander	\N	mnu912DZCOM	\N	\N	2016-10-15 18:44:09.648+00	2016-10-15 18:44:09.648+00	\N	12
41	Drop Fleet Commander	\N	mnu912DFCOM	\N	\N	2016-10-15 18:44:42.216+00	2016-10-15 18:44:42.216+00	\N	12
42	Dead Zone	\N	mnu913DEADZO	\N	\N	2016-10-15 18:45:12.378+00	2016-10-15 18:45:12.378+00	\N	13
43	Dread Ball	\N	mnu913DREAD	\N	\N	2016-10-15 18:45:43.12+00	2016-10-15 18:45:43.12+00	\N	13
44	King of War	\N	mnu913KINGSOW	\N	\N	2016-10-15 18:46:03.233+00	2016-10-15 18:46:03.233+00	\N	13
45	Warpath	\N	mnu913WARPA	\N	\N	2016-10-15 18:46:21.982+00	2016-10-15 18:46:21.982+00	\N	13
46	Relic Knights	\N	mnu914RELIC	\N	\N	2016-10-15 18:46:45.754+00	2016-10-15 18:46:45.754+00	\N	14
47	Wild West Exodus	\N	mnu915WILDW	\N	\N	2016-10-15 18:47:19.902+00	2016-10-15 18:47:19.902+00	\N	15
48	Robotech Tactics	\N	mnu916ROBOT	\N	\N	2016-10-15 18:47:50.363+00	2016-10-15 18:47:50.363+00	\N	16
49	Warmachine/Hordes	\N	mnu917WARHOR	\N	\N	2016-10-15 18:48:21.87+00	2016-10-15 18:48:21.87+00	\N	17
50	Warzone	\N	mnu918WARZO	\N	\N	2016-10-15 18:48:44.61+00	2016-10-15 18:48:44.61+00	\N	18
51	Last Saga	\N	mnu919LASTSA	\N	\N	2016-10-15 18:49:16.406+00	2016-10-15 18:49:16.406+00	\N	19
52	Dystopian Legions	\N	mnu920DYSLE	\N	\N	2016-10-15 18:49:43.619+00	2016-10-15 18:49:43.619+00	\N	20
53	Dystopian Wars	\N	mnu920DYSWA	\N	\N	2016-10-15 18:50:16.971+00	2016-10-15 18:50:16.971+00	\N	20
54	Firestorm Armada	\N	mnu920FIREARM	\N	\N	2016-10-15 18:50:41.885+00	2016-10-15 18:50:41.885+00	\N	20
55	Firestorm Planetfall	\N	mnu920FIREPL	\N	\N	2016-10-15 18:51:21.407+00	2016-10-15 18:51:21.407+00	\N	20
56	Armoured Clash	\N	mnu920ARMCLA	\N	\N	2016-10-15 18:52:05.182+00	2016-10-15 18:52:05.182+00	\N	20
57	Halo Fleet Battles	\N	mnu920HALOFB	\N	\N	2016-10-15 18:52:32.163+00	2016-10-15 18:52:32.163+00	\N	20
58	Maelstrom's Edge	\N	mnu921MAELED	\N	\N	2016-10-15 18:53:17.711+00	2016-10-15 18:53:17.711+00	\N	21
59	Saga	\N	mnu922SAGA	\N	\N	2016-10-15 18:53:50.347+00	2016-10-15 18:53:50.347+00	\N	22
60	Black Powder	\N	mnu923BLACK	\N	\N	2016-10-15 18:54:20.215+00	2016-10-15 18:54:20.215+00	\N	23
61	Bolt Action	\N	mnu923BOLTA	\N	\N	2016-10-15 18:55:11.247+00	2016-10-15 18:55:11.247+00	\N	23
62	Hail Caesar	\N	mnu923HAILC	\N	\N	2016-10-15 18:55:42.418+00	2016-10-15 18:55:42.418+00	\N	23
63	Pike & Shotte	\N	mnu923PIKESH	\N	\N	2016-10-15 18:56:31.533+00	2016-10-15 18:56:31.533+00	\N	23
64	Beyond the Gates of Antares	\N	mnu923BTGOA	\N	\N	2016-10-15 18:57:01.143+00	2016-10-15 18:57:01.143+00	\N	23
65	Magic The Gathering	\N	mnu924MAGTG	\N	\N	2016-10-15 18:57:27.096+00	2016-10-15 18:57:27.096+00	\N	24
66	D&D Attack Wing	\N	mnu925DDAWI	\N	\N	2016-10-15 18:58:04.602+00	2016-10-15 18:58:04.602+00	\N	25
67	Hero Clicks	\N	mnu925HEROC	\N	\N	2016-10-15 18:58:28.457+00	2016-10-15 18:58:28.457+00	\N	25
68	Star Trek Attack Wing	\N	mnu925STARTAW	\N	\N	2016-10-15 18:58:56.003+00	2016-10-15 18:58:56.003+00	\N	25
69	Malifaux	\N	mnu926MALIF	\N	\N	2016-10-15 18:59:22.371+00	2016-10-15 18:59:22.371+00	\N	26
70	Kill Team	\N	mnu926KILLTE	\N	\N	2016-10-19 22:31:34.417+00	2016-10-19 22:31:34.417+00	\N	10
19	Tester	\N	mnu908WAR40K	\N	\N	2016-10-15 18:38:58.491+00	2016-11-01 23:55:58.949+00	\N	8
\.


--
-- Name: GameSystems_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"GameSystems_id_seq"', 70, true);


--
-- Data for Name: Manufacturers; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "Manufacturers" (id, name, "searchKey", description, photo, url, "createdAt", "updatedAt") FROM stdin;
1	Miscellaneous	mnu901	\N	\N	\N	2016-10-15 16:55:22.169+00	2016-10-15 17:00:35.324+00
2	Battlefront Miniatures	mnu902	\N	\N	\N	2016-10-15 17:03:30.648+00	2016-10-15 17:03:30.648+00
3	Cipher Studios	mnu903	\N	\N	\N	2016-10-15 17:04:35.545+00	2016-10-15 17:04:35.545+00
4	Cool Mini or Not	mnu904	\N	\N	\N	2016-10-15 17:05:15.891+00	2016-10-15 17:05:15.891+00
5	Corvus Belli	mnu905	\N	\N	\N	2016-10-15 17:05:42.835+00	2016-10-15 17:05:42.835+00
6	Dark Age Miniatures	mnu906	\N	\N	\N	2016-10-15 17:06:03.79+00	2016-10-15 17:06:03.79+00
7	Dream Pod 9	mnu907	\N	\N	\N	2016-10-15 17:06:32.267+00	2016-10-15 17:06:32.267+00
8	Fantasy Flight Games	mnu908	\N	\N	\N	2016-10-15 17:06:48.102+00	2016-10-15 17:06:48.102+00
9	Forge World (Games Workshop)	mnu909	\N	\N	\N	2016-10-15 17:08:57.221+00	2016-10-15 17:08:57.221+00
10	Games Workshop	mnu910	\N	\N	\N	2016-10-15 17:10:22.544+00	2016-10-15 17:10:22.544+00
11	GCT Studios	mnu911	\N	\N	\N	2016-10-15 17:10:45.784+00	2016-10-15 17:10:45.784+00
12	Hawk Wargames	mnu912	\N	\N	\N	2016-10-15 17:11:23.02+00	2016-10-15 17:11:23.02+00
13	Mantic	mnu913	\N	\N	\N	2016-10-15 17:11:40.167+00	2016-10-15 17:11:40.167+00
14	Ninja Division	mnu914	\N	\N	\N	2016-10-15 17:12:01.136+00	2016-10-15 17:12:01.136+00
15	Outlaw Games	mnu915	\N	\N	\N	2016-10-15 17:12:24.165+00	2016-10-15 17:12:24.165+00
16	Palladium Books	mnu916	\N	\N	\N	2016-10-15 17:12:52.712+00	2016-10-15 17:12:52.712+00
17	Privateer Press	mnu917	\N	\N	\N	2016-10-15 17:13:14.638+00	2016-10-15 17:13:14.638+00
18	Prodos	mnu918	\N	\N	\N	2016-10-15 17:13:31.362+00	2016-10-15 17:13:31.362+00
19	Rocket Games	mnu919	\N	\N	\N	2016-10-15 17:13:45.004+00	2016-10-15 17:13:45.004+00
20	Spartan Games	mnu920	\N	\N	\N	2016-10-15 17:14:01.256+00	2016-10-15 17:14:01.256+00
21	Spiral Arm Studios	mnu921	\N	\N	\N	2016-10-15 17:14:25.056+00	2016-10-15 17:14:25.056+00
22	Tomahawk Studios	mnu922	\N	\N	\N	2016-10-15 17:14:50.753+00	2016-10-15 17:14:50.753+00
23	Warlord Games	mnu923	\N	\N	\N	2016-10-15 17:15:10.775+00	2016-10-15 17:15:10.775+00
24	Wizards of the Coast (Hasbro)	mnu924	\N	\N	\N	2016-10-15 17:15:31.544+00	2016-10-15 17:15:31.544+00
25	Wizkids	mnu925	\N	\N	\N	2016-10-15 17:15:59.108+00	2016-10-15 17:15:59.108+00
26	Wyrd	mnu926	\N	\N	\N	2016-10-15 17:16:15.085+00	2016-10-15 17:16:15.085+00
\.


--
-- Name: Manufacturers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Manufacturers_id_seq"', 26, true);


--
-- Data for Name: NewsPosts; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "NewsPosts" (id, title, image, callout, body, published, featured, tags, "manufacturerId", "gameSystem", category, "createdAt", "updatedAt", "UserId", "ManufacturerId", "FactionId", "GameSystemId") FROM stdin;
1	RP Store Testing	1475884859682-plaque-logo.png	We're getting excited to start user testing of the Reward Point Store next weekend! We'll be providing additional info for people interested in helping us with user testing the beginning of next week.\nAs a Battle-comm member you will earn Reward Points in various ways (running/paparticipating in tournaments, hobby workshops, demos, etc.) at your local gaming store and gaming conventions that are then deposited in your Battle-comm Reward Point Stash. You can then purchase hobby and tabletop gaming product for Reward Points In the Battle-comm Reward Point Store.\n100 Battle-comm Reward Points = $1\nFree shipping\nWe will start providing additional details about the Battle-comm service this weekend!\nBryce	We're getting excited to start user testing of the Reward Point Store next weekend! We'll be providing additional info for people interested in helping us with user testing the beginning of next week.\nAs a Battle-comm member you will earn Reward Points in various ways (running/paparticipating in tournaments, hobby workshops, demos, etc.) at your local gaming store and gaming conventions that are then deposited in your Battle-comm Reward Point Stash. You can then purchase hobby and tabletop gaming product for Reward Points In the Battle-comm Reward Point Store.\n100 Battle-comm Reward Points = $1\nFree shipping\nWe will start providing additional details about the Battle-comm service this weekend!\nBryce	f	f	general, testing, news	mnu901	mnu901CHESS	General	2016-10-07 22:58:03.463+00	2016-10-08 00:01:03.673+00	3	\N	\N	\N
\.


--
-- Name: NewsPosts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"NewsPosts_id_seq"', 3, true);


--
-- Data for Name: ProductOrders; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "ProductOrders" (id, status, "orderDetails", "orderTotal", "customerFullName", "customerEmail", phone, "shippingStreet", "shippingAppartment", "shippingCity", "shippingState", "shippingZip", "shippingCountry", "createdAt", "updatedAt", "UserId") FROM stdin;
\.


--
-- Name: ProductOrders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"ProductOrders_id_seq"', 1, false);


--
-- Data for Name: Products; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "Products" (id, "SKU", name, price, description, "manufacturerId", "gameSystem", color, tags, category, "stockQty", "inStock", "filterVal", "displayStatus", featured, new, "onSale", "imgAlt", "imgOneFront", "imgOneBack", "imgTwoFront", "imgTwoBack", "imgThreeFront", "imgThreeBack", "imgFourFront", "imgFourBack", "createdAt", "updatedAt", "ManufacturerId", "FactionId", "GameSystemId") FROM stdin;
1	0000001	Great Escape Games 5% Discount	250	5% off a $ purchase with Great Escape Games	mnu910	mnu910WAR40K	\N	FLGS, discount, Great Escape Games	Misc.	1000000	t	showit	t	f	t	f	FLGS Discount	1475883976187-default.jpg	1475883981920-default.jpg	\N	\N	\N	\N	\N	\N	2016-10-07 17:57:31.774+00	2016-10-07 23:46:27.104+00	\N	\N	\N
\.


--
-- Name: Products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Products_id_seq"', 4, true);


--
-- Data for Name: UserAchievements; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "UserAchievements" (id, title, "createdAt", "updatedAt", "UserId") FROM stdin;
\.


--
-- Name: UserAchievements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"UserAchievements_id_seq"', 1, false);


--
-- Data for Name: UserMessages; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "UserMessages" (id, status, "createdAt", "updatedAt", "UserId") FROM stdin;
\.


--
-- Name: UserMessages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"UserMessages_id_seq"', 1, false);


--
-- Data for Name: UserNotifications; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "UserNotifications" (id, type, status, "fromId", "fromName", "fromUsername", "createdAt", "updatedAt", "UserId") FROM stdin;
62	friendshipAccepted	unRead	9	Friend Two	friend2	2016-10-08 20:40:16.452+00	2016-10-08 20:40:16.452+00	8
63	friendshipAccepted	unRead	10	Friend Three	friend3	2016-10-08 20:40:38.626+00	2016-10-08 20:40:38.626+00	8
65	friendshipAccepted	unRead	9	Friend Two	friend2	2016-10-08 20:41:15.535+00	2016-10-08 20:41:15.535+00	10
68	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-10-08 20:44:15.911+00	2016-10-08 20:44:15.911+00	6
71	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-10-10 16:10:19.566+00	2016-10-10 16:10:19.566+00	15
72	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-10-10 16:10:39.341+00	2016-10-10 16:10:39.341+00	23
73	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-10-10 16:10:55.73+00	2016-10-10 16:10:55.73+00	21
74	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-10-10 16:11:13.754+00	2016-10-10 16:11:13.754+00	19
75	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-10-10 16:11:32.182+00	2016-10-10 16:11:32.182+00	22
76	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-10-10 16:11:54.872+00	2016-10-10 16:11:54.872+00	11
79	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-10-10 19:34:41.328+00	2016-10-10 19:34:41.328+00	23
80	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-10-10 19:34:54.384+00	2016-10-10 19:34:54.384+00	11
82	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-10-10 19:35:43.642+00	2016-10-10 19:35:43.642+00	15
29	friendshipAccepted	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-10-08 00:06:47.952+00	2016-10-08 00:06:47.952+00	6
83	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-10-10 19:35:54.963+00	2016-10-10 19:35:54.963+00	16
86	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-11-10 16:02:47.757+00	2016-11-10 16:02:47.757+00	30
95	friendshipAccepted	unRead	12	Tony Myers	Dayone916	2016-11-15 22:23:45.652+00	2016-11-15 22:23:45.652+00	32
97	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:24:34.138+00	2016-11-15 22:24:34.138+00	22
98	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:24:52.793+00	2016-11-15 22:24:52.793+00	23
99	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:25:11.713+00	2016-11-15 22:25:11.713+00	15
100	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:25:29.359+00	2016-11-15 22:25:29.359+00	11
101	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:25:48.066+00	2016-11-15 22:25:48.066+00	29
102	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:26:23.202+00	2016-11-15 22:26:23.202+00	24
103	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:26:46.731+00	2016-11-15 22:26:46.731+00	17
104	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:34:17.932+00	2016-11-15 22:34:17.932+00	18
105	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:34:34.471+00	2016-11-15 22:34:34.471+00	20
106	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:34:56.343+00	2016-11-15 22:34:56.343+00	31
107	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:35:29.206+00	2016-11-15 22:35:29.206+00	21
108	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:36:29.889+00	2016-11-15 22:36:29.889+00	6
109	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:36:57.396+00	2016-11-15 22:36:57.396+00	16
110	friendRequest	unRead	12	Tony Myers	Dayone916	2016-11-15 22:37:33.445+00	2016-11-15 22:37:33.445+00	19
111	friendRequest	unRead	27	Richard Sparks	richard.sparks1976@yahoo.com	2016-11-16 01:41:43.158+00	2016-11-16 01:41:43.158+00	12
113	friendshipAccepted	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-11-18 02:32:37.387+00	2016-11-18 02:32:37.387+00	36
117	friendshipAccepted	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-11-19 00:37:32.497+00	2016-11-19 00:37:32.497+00	37
120	friendshipAccepted	unRead	27	Richard Sparks	richard.sparks1976@yahoo.com	2016-11-19 00:45:27.407+00	2016-11-19 00:45:27.407+00	12
121	friendshipAccepted	unRead	27	Richard Sparks	richard.sparks1976@yahoo.com	2016-11-19 00:45:32.27+00	2016-11-19 00:45:32.27+00	37
122	friendshipAccepted	unRead	27	Richard Sparks	richard.sparks1976@yahoo.com	2016-11-19 00:45:37.601+00	2016-11-19 00:45:37.601+00	38
125	friendRequest	unRead	41	Peter Peter	Pandan0w	2016-11-22 01:36:25.177+00	2016-11-22 01:36:25.177+00	27
126	friendRequest	unRead	5	Bryce Nelson	bnelson@battle-comm.com	2016-11-22 06:08:30.065+00	2016-11-22 06:08:30.065+00	41
127	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-11-22 17:41:30.012+00	2016-11-22 17:41:30.012+00	29
128	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-11-22 17:41:45.63+00	2016-11-22 17:41:45.63+00	24
129	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-11-22 17:42:26.204+00	2016-11-22 17:42:26.204+00	17
130	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-11-22 17:42:43.471+00	2016-11-22 17:42:43.471+00	20
131	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-11-22 17:43:03.225+00	2016-11-22 17:43:03.225+00	27
132	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-11-22 17:43:10.648+00	2016-11-22 17:43:10.648+00	31
133	friendRequest	unRead	1	Zack Anselm	zdizzle6717	2016-11-22 17:43:30.667+00	2016-11-22 17:43:30.667+00	40
136	friendRequest	unRead	50	Ryan Yamadera	rjy22@ymail.com	2017-03-27 23:08:59.37+00	2017-03-27 23:08:59.37+00	44
\.


--
-- Name: UserNotifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"UserNotifications_id_seq"', 136, true);


--
-- Data for Name: UserPhotos; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "UserPhotos" (id, url, "createdAt", "updatedAt", "UserId") FROM stdin;
1	1475798943555-WyrdCrookedMen.jpg	2016-10-07 00:09:03.921+00	2016-10-07 00:09:03.921+00	2
2	1475798956260-WyrdHog-Whisperer.jpg	2016-10-07 00:09:16.505+00	2016-10-07 00:09:16.505+00	2
3	1475798968927-WyrdBayouGators.jpg	2016-10-07 00:09:29.182+00	2016-10-07 00:09:29.182+00	2
4	1475798975215-WyrdWarPig.jpg	2016-10-07 00:09:35.466+00	2016-10-07 00:09:35.466+00	2
5	1475800489502-IMG_0009.JPG	2016-10-07 00:34:49.706+00	2016-10-07 00:34:49.706+00	3
6	1475805146934-IMG_0011.JPG	2016-10-07 01:52:27.116+00	2016-10-07 01:52:27.116+00	5
7	1475941558772-Untitled.png	2016-10-08 15:45:59.094+00	2016-10-08 15:45:59.094+00	1
8	1475941624985-Untitled.png	2016-10-08 15:47:05.262+00	2016-10-08 15:47:05.262+00	1
9	1476081480746-IMG_1972.JPG	2016-10-10 06:38:00.94+00	2016-10-10 06:38:00.94+00	12
10	1476137268279-IMG_20161010_165300.jpg	2016-10-10 22:07:48.733+00	2016-10-10 22:07:48.733+00	1
11	1478917310830-imagesCAJFBSM6.jpg	2016-11-12 02:21:59.475+00	2016-11-12 02:21:59.475+00	31
12	1478917344712-ironmanfabman.jpg	2016-11-12 02:22:25.085+00	2016-11-12 02:22:25.085+00	31
13	1478917513987-tlgt_logo2-01 (1).png	2016-11-12 02:25:14.46+00	2016-11-12 02:25:14.46+00	31
14	1478918053769-tlgt_warboss logo3.jpg	2016-11-12 02:34:14.221+00	2016-11-12 02:34:14.221+00	31
15	1478918176689-tlgt_Incubi_patch_ final.png	2016-11-12 02:36:17.01+00	2016-11-12 02:36:17.01+00	31
\.


--
-- Name: UserPhotos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"UserPhotos_id_seq"', 19, true);


--
-- Data for Name: UserRankings; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "UserRankings" (id, "totalWins", "totalLosses", "totalDraws", "createdAt", "updatedAt", "FactionId", "GameSystemId", "UserId") FROM stdin;
\.


--
-- Name: UserRankings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"UserRankings_id_seq"', 1, false);


--
-- Data for Name: Users; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "Users" (id, email, password, "firstName", "lastName", member, "tourneyAdmin", "eventAdmin", "newsContributor", "venueAdmin", "clubAdmin", "systemAdmin", username, club, "mainPhone", "mobilePhone", "streetAddress", "aptSuite", city, state, zip, dob, bio, facebook, twitter, instagram, "googlePlus", youtube, twitch, website, "rewardPoints", visibility, "shareContact", "shareName", "shareStatus", newsletter, marketing, sms, "allowPlay", icon, "eloRanking", "accountActive", "createdAt", "updatedAt", "UserId", subscriber) FROM stdin;
22	cpcarrot@aol.com	$2a$10$PsKAYcNR0MbNJhQiaHufBOv1nfH.sJLaJ1mjVBd674MsYfy0liWou	Mike	Hancho	t	f	f	f	f	f	f	Jesus hates you	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-10 02:02:33.645+00	2016-10-10 02:02:33.645+00	\N	f
9	friend2@email.com	$2a$10$UxU5l4lkmYheDbMG04J3T.hsaMr5miXVMzQ0z790Po2B2VoBAJAeu	Friend	Two	t	f	f	f	f	f	f	friend2	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1475955350442-2.png	0	\N	2016-10-08 19:35:43.569+00	2016-10-08 20:04:07.513+00	8	f
8	friend1@email.com	$2a$10$Q79oHYetxSxeyq8GEd3vLOiXMlQ/tnsmWN/TQhxFMCqeHZ0mVsxNK	Friend	One	t	f	f	f	f	f	f	friend1	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1475955316646-1.png	0	\N	2016-10-08 19:34:35.048+00	2016-10-08 20:04:07.525+00	9	f
10	friend3@email.com	$2a$10$SRv94l8vNh0m4T956tDPIO7KlNw1t/.yFm.wb.nmB8jo17qydR7ZK	Friend	Three	t	f	f	f	f	f	f	friend3	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1475957485163-3.png	0	\N	2016-10-08 19:53:34.449+00	2016-10-08 20:11:25.51+00	8	f
23	benvaun@yahoo.com	$2a$10$VuAMFArjPLl./B8GtXZo0.tjo2IUEvBzeR76.k.ytSI03lE9H4Sgq	Ben	Vaughan	t	f	f	f	f	f	f	BenVaughan	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-10 02:27:25.337+00	2016-10-10 02:27:25.337+00	\N	f
11	vasquez.mason@yahoo.com	$2a$10$ju6Tzw6TARODdhkO6DK7PeDVLsnO4AYLugoMvzP8Wg8eOqg40TmFq	Mason	Vasquez	t	f	f	f	f	f	f	Masos	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 18:29:04.693+00	2016-10-09 18:29:04.693+00	\N	f
13	ajdimeola@yahoo.com	$2a$10$9/9HQyTea9qA1rHRuba58OTomT.X7ZEV93ULqXuC6BhQ2GCJoP8Ve	Anthony	DiMeola	t	f	f	f	f	f	f	Dr_Damo	\N	\N	\N	\N	\N	\N	\N	\N	\N	Play to have fun but will try agents what Evers op at the moment	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1476038032049-IMG_0384.JPG	0	\N	2016-10-09 18:33:13.813+00	2016-10-09 18:39:07.865+00	\N	f
6	torpored@yahoo.com	$2a$10$QfEBk7AQzzDqeTeb.7XFCuZry4eYqDsB5Z4OxSaLrDuxpSfopgAQe	Josh	Rosenstein	t	f	f	f	f	f	f	Torpored	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-08 00:05:13.552+00	2016-10-08 00:06:49.107+00	5	f
24	scott.anderson1219@hotmail.com	$2a$10$ffdUlXVphnE9NLv8i4.TxuUedwP25o40Jr4jEBBnnqcn5aoVf09P6	Scott	Anderson	t	f	f	f	f	f	f	MysticMonkKern	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-22 16:41:18.218+00	2016-10-22 16:41:18.218+00	\N	f
14	mccool.john@yahoo.com	$2a$10$rNL37Uq9YBq6WyubSZfv0eGp6e9vBT70Xgl3l0x6PMRorJDwa3aNO	John	Mccool	t	f	f	f	f	f	f	Mccoolislove	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 18:40:28.702+00	2016-10-09 18:40:28.702+00	\N	f
2	venueAdmin@email.com	$2a$10$FVkZkZufp2MSplIn8/FulOQt3.4YmtG.2ZpiFHoMV8hF/BuqZVzBC	Venue	Admin	t	f	f	f	t	f	f	venueAdmin	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-06 23:11:12.688+00	2016-10-08 00:29:02.743+00	1	f
15	floydfos@hotmail.com	$2a$10$YEs1eHCb5avO91T/e0pXm..phJP81XTTip1ek9eoi1HNmr/3Y6NnG	Austin	Warner	t	f	f	f	f	f	f	Redbeard	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 18:45:29.723+00	2016-10-09 18:45:29.723+00	\N	f
25	cperriraz@gmail.com	$2a$10$RftelGD55sZcvRq102YdBukuuAIX6pjlNrhhVHsjB5rOY9NRwnRxC	Chris	Perriraz	t	f	f	f	f	f	f	CPerriraz	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-29 03:10:36.131+00	2016-10-29 03:10:36.131+00	\N	f
5	bnelson@battle-comm.com	$2a$10$SQYzPfY9aJytVSZhEojE.ugWRARUsHU0VZxvd6YFMIPMJg2008pxi	Bryce	Nelson	t	f	f	f	t	f	t	TheDude	\N	\N	\N	\N	\N	\N	\N	\N	\N	The dude is the dude...is the dude.	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	1475812710783-IMG_0016.PNG	0	\N	2016-10-07 01:48:21.117+00	2016-10-08 00:36:21.294+00	1	f
7	zack@treemachinerecords.com	$2a$10$x1hhFy9dNHJaDKTpXz/v2ejkvDwSJt9gqJTkDbbrympXX2TV6FyX2	Tree	Machine	t	f	f	f	f	f	f	treemachine	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1475885423617-FWI_Logo_Alt.png	0	\N	2016-10-08 00:10:01.582+00	2016-10-08 00:39:48.836+00	1	f
17	lucas.g.king@gmail.com	$2a$10$yzFkt43NZA4c44wBLdwHw.hx0UhDno.wJtSy/qPVS6TlrJB7XRpxe	Lucas	King	t	f	f	f	f	f	f	Moriks	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 19:27:45.837+00	2016-10-09 19:27:45.837+00	\N	f
18	riskhalo@hotmail.com	$2a$10$w2ZYpwALAy4xpKx20Gc68OxZzOGqX9lC3OcrpSkwyEMdrU2k1Lo8m	Austin	Brooks	t	f	f	f	f	f	f	Snow	\N	\N	\N	\N	\N	\N	\N	\N	\N	Space Marines!!!!!!!!!!	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 19:32:14.633+00	2016-10-09 19:33:12.227+00	\N	f
19	rolgnek@gmail.com	$2a$10$1RrUc/BV9/rDjEfIaYRn8ODuUeb0GEyKZq8MZtV/d8EzV1WkGOfIi	Steve	Sisk	t	f	f	f	f	f	f	Rolgnek	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 20:12:51.717+00	2016-10-09 20:12:51.717+00	\N	f
20	docdragonis@yahoo.com	$2a$10$nwbzRGKwaRhxweit02XJiezi8j.qz9R/79wdO9OGLdIALi8E.JrgW	Doc	Dragon	t	f	f	f	f	f	f	Docdragon	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 20:45:54.773+00	2016-10-09 20:45:54.773+00	\N	f
28	sthiers@ymail.com	$2a$10$ZzcfFwWtPIxLZys51wRxv.hxEz.CxEipYjM2NKprTUC8DRqgybRTu	Shaun	Thiers	t	f	f	f	f	f	f	Lodbrok	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-02 22:46:04.082+00	2016-11-02 22:46:04.082+00	\N	f
30	asyouwish1978@gmail.com	$2a$10$YjKNPbUz4I2VgyWde1rmiOJ25DL0cfOxu.9eRcCtBDkaskp3Fw3P.	Crissy	Dubois	t	f	f	f	t	f	f	TyrantButtercup	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-08 16:44:24.526+00	2016-11-10 16:01:09.916+00	\N	f
31	Omegaprime69@Gmail.com	$2a$10$Mg0efKsyA841kzXhK/w6TuLUkqc1q1KIy8wqIf2m1aRpnGG0U6CMO	Mark	Broughton	t	f	f	f	t	f	f	Omegaprime	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-12 02:19:18.322+00	2016-11-12 02:22:37.096+00	\N	f
16	luke.pallas@gmail.com	$2a$10$cW6KC8TZDYghMTp//.vk/uRFuBrtToZD.zm4nVfgsj9xTuARfTh3.	Luke	Pallas	t	f	f	f	f	f	f	Dustin1209	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 19:24:43.418+00	2016-11-12 05:50:26.598+00	\N	f
36	jorgemikekirby@yahoo.com	$2a$10$TyDgLNAubNFP4qhhkxqqJeKOKkTQVoLnYhrv7PDnjDYenS2dLZTvm	Jorge	Kirby	t	f	f	f	f	f	f	Nubalish	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-18 02:25:42.893+00	2016-11-18 02:26:00.28+00	\N	f
29	spalmer286@gmail.com	$2a$10$jgqcsVS301.i5q3aq0WTRuLuw/xZncyGR5BkG.oJMdOt.OLcUqbYe	Sean	Palmer	t	f	f	f	t	f	f	The Canuck	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-05 17:38:37.547+00	2017-02-03 19:53:56.953+00	\N	f
4	subscriber@email.com	$2a$10$oIU7wkgm/uGc.f4RoIlRueyQPeBAVO1PdiElhfBU8Pa5eEafIU2By	Subscriber	Role	t	f	f	f	f	f	f	subscriber	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1475797383527-friend.jpg	0	\N	2016-10-06 23:39:11.76+00	2017-01-11 23:57:41.834+00	1	t
1	zanselm5@gmail.com	$2a$10$w.1Xaga4.Wg5rqcUj4wvbuHemb/wb1XtwqArI6jfd6cnUEFMf8dI.	Zack	Anselm	t	f	f	f	f	f	f	zdizzle6717	\N	\N	\N	\N	\N	\N	\N	\N	\N	Help us make Battle-Comm something awesome! Recomendations are welcome.	\N	https://twitter.com/Zdizzle6717	https://www.instagram.com/treemachinerecords	\N	\N		http://www.TreeMachineRecords.com	0	\N	\N	\N	\N	\N	\N	\N	\N	1475944554290-H12dA3L3.png	0	\N	2016-10-06 23:10:28.38+00	2017-01-15 20:31:39.435+00	7	t
21	loyce8869@gmail.com	$2a$10$TaRS0e8JvTe0Fvo/JBja0u1nrFGGfc7QtrSoPOD6haHFzUKuJh5nW	Mike	Benton	t	f	f	f	f	f	f	Loyce8869	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-10 01:57:23.566+00	2017-02-19 06:44:46.934+00	\N	f
12	dayone916@outlook.com	$2a$10$4XdH6UN4plWQTiFqU/WwHeeBPiiCM9CZCM8hOIoQmvB9ozpJOB96a	Tony	Myers	t	f	f	f	t	f	f	Dayone916	\N	9167160053	\N	\N	\N	\N	\N	\N	\N	40k player: space marines, eldar, grey Knights, admech/warconvocation, imperial knights\n\nCofounder / club president of meta mafia\n\nOwner of Hammerhead Games	\N	\N	\N	\N	\N	\N	\N	8300	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-09 18:32:49.606+00	2017-03-01 15:53:17.231+00	\N	f
32	bfreed96@gmail.com	$2a$10$aiXlytVv9d53b/Lz1uJ3iO2R1k.EnO2gHAJhQAiR9.b8fzFuyucEO	Branson	Freed	t	f	f	f	f	f	f	MastaFreed	\N	\N	\N	\N	\N	\N	\N	\N	\N	40k player: Adepta Sororitas/Sisters of Battle, Inquisition, Militarum Tempestus, Astra Militarum. Looking to try out new systems and explore all that tabletop war gaming has to offer!	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-12 07:50:59.151+00	2016-11-12 07:54:59.997+00	\N	f
33	predator_47_47@yahoo.com	$2a$10$tLL50MwMlZSnGtvJHdG9ReLYQl0eiYVaB4zD46ImRt5lbiNX8i00.	Marcus	Aurelius	t	f	f	f	t	f	f	Aurelius47	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-15 21:09:12.695+00	2016-11-29 17:58:09.993+00	\N	f
27	richard.sparks1976@yahoo.com	$2a$10$qUIXy3WFicCuu6dhZK7xbeqWYjGdzQ/s3ngjPB/fNl7cjxZStYAXq	Richard	Sparks	t	f	f	f	t	f	f	Richard	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-02 22:11:15.967+00	2016-11-15 22:06:00.018+00	\N	f
26	heathernana27@gmail.com	$2a$10$/K8QLYwvQyiALA5ITcRl/u4jHrtqkaJUblaTWaf0bFC/xc2vOmkCG	Heather	Leggett	t	f	f	f	f	f	f	Nekimalovelace	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-29 03:18:10.004+00	2016-11-18 03:34:47.138+00	\N	f
35	ryuondo@gmail.com	$2a$10$jWg8h5CKMoQ69L88erdfSeBOPDwJ3Lq7/VFEPIOcDAJu7yGeKsjJ2	Zachary	Walker	t	f	f	f	f	f	f	Ryuondo	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-15 23:50:58.036+00	2016-11-15 23:50:58.036+00	\N	f
37	nolanenator@gmail.com	$2a$10$mIJFUEcBmrDnvfkzLNT2e.WUzco7oZyRKOLNSV1RC3GemyDbj7lIS	nolan	bloyd	t	f	f	f	f	f	f	Loki	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-19 00:32:32.918+00	2016-11-19 00:32:32.918+00	\N	f
38	daniel.hau.yau@gmail.com	$2a$10$zQulfFS.X5x4j6wp6iow8Ovs1baIeugBHSMg6cVrcn17mqEugFRgK	Daniel	Hau	t	f	f	f	f	f	f	TacosInDistress	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-19 00:37:26.177+00	2016-11-19 00:37:26.177+00	\N	f
39	reinwald@hotmail.com	$2a$10$7EnBaZ0l5S7kx5Oy03F5.OnHP3Z/I.jfRbUHMzyHG1yYuasgQ/vKG	josh	reinwald	t	f	f	f	f	f	f	reinwald	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-19 08:26:06.087+00	2016-11-19 08:26:06.087+00	\N	f
40	GordonDanke@gmail.com	$2a$10$Hf145n.ajn/2PsWo5P/NrO6WLP9ciLfNfBAsLOCbZcPLRPKDLtJPi	Gordon	Danke	t	f	f	f	t	f	t	DarkLink	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-11-20 20:38:32.694+00	2016-11-20 20:47:42.822+00	\N	f
41	thisbeapanda@gmail.com	$2a$10$bfbIqzMy3hyDmjPkWEaGHOr/ZXc9cK7UrnBHAh7cwa/69V.4bRM3u	Peter	Opdahl	t	f	f	f	f	f	f	Pandan0w	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1479778105251-80dc606b4d738398b039827599e2946489b13d49d4696bf8f6d2cccdac13a228u18.png	0	\N	2016-11-22 01:27:05.035+00	2016-11-22 01:28:25.577+00	\N	f
51	mttmart@gmail.com	$2a$10$32XWSEUzw5kLKTa59.l.iO83jg4NUMew.W1qhsVSQ0B2KCxx8547u	Matthew	Martini	t	f	f	f	f	f	f	Grotliquor	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2400	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 19:28:46.912+00	2017-02-20 20:14:47.859+00	\N	f
3	systemAdmin@email.com	$2a$10$sBx3uWAOXsnoVeiNpnb1PebijFN6AiTEe9ff3BjNnL6jLPmvs4xvG	System	Admin	t	t	f	f	f	f	t	systemAdmin	\N	\N	\N	\N	\N	\N	\N	\N	\N	I'm in the system!	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-10-06 23:18:13.267+00	2017-01-15 17:46:38.572+00	1	f
42	david95608@hotmail.com	$2a$10$Fz4/yNp4B3pypNi.gNchleI8HWCY2EUYVvjdUArkm3tnR2QjOTUei	David	Parigini	t	f	f	f	t	f	t	Servitor X	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2016-12-12 01:02:52.966+00	2017-01-16 00:10:15.205+00	\N	f
43	oelber@gmail.com	$2a$10$DRquUkAnd53lySsI4gIadO2yR1ReNnQYCew9rYPdyzCmgmhtgI8H.	Colby	Cram	t	f	f	f	f	f	f	Oelber	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-01-26 05:29:06.287+00	2017-01-26 05:29:06.287+00	\N	f
46	sergio.rodriguez421@yahoo.com	$2a$10$AtXnkwaokOwbHpq3BApbquMN9ibRgn4gsF/0bYPiG0WxXaEWYbAE2	Sergio	Rodriguez	t	f	f	f	f	f	f	Seated	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 12:49:33.894+00	2017-02-28 23:48:38.374+00	\N	f
34	darkangel0@hotmail.com	$2a$10$amZk1SJmNabKjid0CyI6U.A3JM4BMSpwJE8PRU/TFir/8sBb5/k4C	Joshua	Costanich	t	f	f	f	t	f	f	Multiple	\N	\N	\N	\N	\N	\N	\N	\N	\N	Sacramento area Pressganger - PG Multiple	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	1486982190293-odin_by_design_by_humans-d8uyqd7.jpg	0	\N	2016-11-15 22:56:25.42+00	2017-02-13 10:37:13.054+00	\N	f
58	johnr.schroeder9@gmail.com	$2a$10$2AU3pgKGo3R4iSHOdiZnz.SY/KrYqfl4ETUMwrp4HArwovoV4L0vq	John	Schroeder	t	f	f	f	f	f	f	Jonjonbegon	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-22 23:34:05.008+00	2017-02-22 23:34:05.008+00	\N	f
44	CaptCommy@gmail.com	$2a$10$/D/Z1T39l20k77Tw6y9dVuulWedBRsuodGYphucuIHjm.FsWJ4/di	Nate	Horn	t	f	f	f	f	f	f	CaptCommy	\N	5859199329	\N	10741 Fair Oaks Blvd	Apt 75	Fair Oaks	California	95628	\N	\N	\N	\N	\N	\N	\N	\N	\N	4500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-12 01:20:22.377+00	2017-02-20 20:15:30.049+00	\N	f
56	marcellinr@gmail.com	$2a$10$ky7vdXYhYjt8lRLIEYPPIexblhx.LCcNDYKMf5WusAfGiIb69gt62	Ryan	Marcellin	t	f	f	f	f	f	f	Marcellin	\N	\N	\N	\N	\N	Tracy	California	95376	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-14 21:36:37.886+00	2017-02-14 21:37:35.34+00	\N	f
55	hiett4@att.net	$2a$10$Jbp23Lori9ijm6JM7vzn2e0182el7uQw.iEYTQMmrsPM5H79tdJgK	Travis	Hiett	t	f	f	f	f	f	f	Travh20	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	5500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-14 04:13:09.589+00	2017-02-15 23:07:33.314+00	\N	f
48	oliwat@comcast.net	$2a$10$JMacQTt7JBFKwPGKeN.37e1yKFCyBV9f.TJPBEh/JD00pXF6FENdm	Steve	Oliver	t	f	f	f	f	f	f	Stoliver	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	3500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 14:42:46.038+00	2017-02-15 23:08:24.509+00	\N	f
52	reinwood99@hotmail.com	$2a$10$HgdG6Ev5XJioxYoN5RjhNewbh6VelAZMTL/QNlkbOIidpLD9O7leS	Jason	David	t	f	f	f	f	f	f	Reinwood	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 23:42:56.963+00	2017-02-15 23:11:11.65+00	\N	f
45	Michaelcarbone@ymail.com	$2a$10$MDiMOab.Lk0GgnMkoyqPK.9JM5chf8BvS9v2U2n37wmRBCrs4vkRe	Michael	Carbone	t	f	f	f	f	f	f	Blacktoad69	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 02:03:21.005+00	2017-02-15 23:12:27.69+00	\N	f
53	aaron.dvillarreal@gmail.com	$2a$10$/obX4pQkS01Sb/r5FFmtrOUA0mqEbLFou5IQyynxr4x2FppQv0Ob.	Aaron	Villarreal	t	f	f	f	f	f	f	Aarondv	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-14 01:51:37.656+00	2017-02-20 20:16:05.329+00	\N	f
47	harkinconner@yahoo.com	$2a$10$q2nEs0lcQ.QMLbxf5LBOGetKNgCLxrW.jPxVB5xVN690cAgyCLhWe	Conner	Harkin	t	f	f	f	f	f	f	Psykes7	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 14:30:55.71+00	2017-02-20 20:16:38.498+00	\N	f
57	mitchellallanryan@hotmail.com	$2a$10$Dqdxajk2MtgBMS2qDOmES.iI.YvReijMKUxE8I0.Sl/CcprOo1u.i	Mitchell	Ryan	t	f	f	f	f	f	f	ALogicalFallacy	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	5500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-20 21:42:35.461+00	2017-03-27 22:56:06.289+00	\N	f
50	rjy22@ymail.com	$2a$10$xqErFRTeBfYIPcrf0nbwNeIW00Ng3LGv/6wkI9ViFcETgHl2zzsQW	Ryan	Yamadera	t	f	f	f	f	f	f	Samiel	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	3500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 17:55:18.801+00	2017-03-27 22:54:56.496+00	\N	f
49	phantasmagorium@gmail.com	$2a$10$5awLe4TGuYupp7NekqWQHedreJR1OM2HbqlHz8r8CGsv1gUy7nhty	Trevor	Bond	t	f	f	f	f	f	f	sedated	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-13 15:09:52.084+00	2017-03-27 22:53:47.667+00	\N	f
59	nova_lead@yahoo.com	$2a$10$07vIvLH6Az9kOX05C0Fjy.BJCm6S0LJ/qpMCT9PDzw/2P3W1TTow6	Jonathan	Elliott	t	f	f	f	f	f	f	Nova_lead	\N	\N	\N	\N	\N	\N	\N	\N	\N	New Player seeks Star Wars Armada gamers in Sacramento	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-23 03:48:27.328+00	2017-02-23 03:49:55.208+00	\N	f
60	dustinlane62@yahoo.com	$2a$10$lywtFGh7xFXK4OKXoMbPGeLOZ7eb/MXfKg7R8e0J3tXnAkfb9mCo6	Dustin	Lane	t	f	f	f	f	f	f	Dustin lane	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-23 20:08:46.858+00	2017-02-23 20:08:46.858+00	\N	f
54	adam.slupik@gmail.com	$2a$10$.ujWI/HAzvo1qVisM5gNQueUr3sGFs14K8h.MHaRRQebKU/Yxl3eG	Adam	Slupik	t	f	f	f	f	f	f	Enjeru	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1300	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	\N	2017-02-14 01:56:59.351+00	2017-03-27 22:56:54.788+00	\N	f
\.


--
-- Name: Users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Users_id_seq"', 60, true);


--
-- Data for Name: userHasFriends; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "userHasFriends" ("createdAt", "updatedAt", "UserId", "FriendId") FROM stdin;
2016-10-08 20:40:16.875+00	2016-10-08 20:40:16.875+00	8	9
2016-10-08 20:40:16.887+00	2016-10-08 20:40:16.887+00	9	8
2016-10-08 20:40:39.962+00	2016-10-08 20:40:39.962+00	8	10
2016-10-08 20:40:39.967+00	2016-10-08 20:40:39.967+00	10	8
2016-10-08 20:41:16.023+00	2016-10-08 20:41:16.023+00	10	9
2016-10-08 20:41:16.027+00	2016-10-08 20:41:16.027+00	9	10
2016-10-10 01:17:55.351+00	2016-10-10 01:17:55.351+00	1	4
2016-10-10 01:17:55.37+00	2016-10-10 01:17:55.37+00	4	1
2016-10-10 16:09:50.479+00	2016-10-10 16:09:50.479+00	1	5
2016-10-10 16:09:50.485+00	2016-10-10 16:09:50.485+00	5	1
2016-11-02 22:25:21.598+00	2016-11-02 22:25:21.598+00	27	5
2016-11-02 22:25:21.604+00	2016-11-02 22:25:21.604+00	5	27
2016-11-12 02:24:03.633+00	2016-11-12 02:24:03.633+00	5	31
2016-11-12 02:24:03.643+00	2016-11-12 02:24:03.643+00	31	5
2016-11-12 05:52:39.233+00	2016-11-12 05:52:39.233+00	5	16
2016-11-12 05:52:39.239+00	2016-11-12 05:52:39.239+00	16	5
2016-11-15 21:11:27.518+00	2016-11-15 21:11:27.518+00	5	33
2016-11-15 21:11:27.524+00	2016-11-15 21:11:27.524+00	33	5
2016-11-15 22:23:36.612+00	2016-11-15 22:23:36.612+00	5	12
2016-11-15 22:23:36.616+00	2016-11-15 22:23:36.616+00	12	5
2016-11-15 22:23:41.442+00	2016-11-15 22:23:41.442+00	1	12
2016-11-15 22:23:41.445+00	2016-11-15 22:23:41.445+00	12	1
2016-11-15 22:23:45.894+00	2016-11-15 22:23:45.894+00	32	12
2016-11-15 22:23:45.897+00	2016-11-15 22:23:45.897+00	12	32
2016-11-18 02:32:37.804+00	2016-11-18 02:32:37.804+00	36	5
2016-11-18 02:32:37.809+00	2016-11-18 02:32:37.809+00	5	36
2016-11-18 03:36:29.751+00	2016-11-18 03:36:29.751+00	5	26
2016-11-18 03:36:29.755+00	2016-11-18 03:36:29.755+00	26	5
2016-11-19 00:37:32.993+00	2016-11-19 00:37:32.993+00	37	5
2016-11-19 00:37:33.001+00	2016-11-19 00:37:33.001+00	5	37
2016-11-19 00:45:27.663+00	2016-11-19 00:45:27.663+00	12	27
2016-11-19 00:45:27.666+00	2016-11-19 00:45:27.666+00	27	12
2016-11-19 00:45:32.736+00	2016-11-19 00:45:32.736+00	37	27
2016-11-19 00:45:32.74+00	2016-11-19 00:45:32.74+00	27	37
2016-11-19 00:45:37.814+00	2016-11-19 00:45:37.814+00	38	27
2016-11-19 00:45:37.817+00	2016-11-19 00:45:37.817+00	27	38
2016-11-20 20:44:29.263+00	2016-11-20 20:44:29.263+00	40	5
2016-11-20 20:44:29.268+00	2016-11-20 20:44:29.268+00	5	40
2016-12-12 01:07:37.891+00	2016-12-12 01:07:37.891+00	42	5
2016-12-12 01:07:37.896+00	2016-12-12 01:07:37.896+00	5	42
\.


--
-- Name: FactionRankings_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "FactionRankings"
    ADD CONSTRAINT "FactionRankings_pkey" PRIMARY KEY (id);


--
-- Name: Factions_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Factions"
    ADD CONSTRAINT "Factions_pkey" PRIMARY KEY (id);


--
-- Name: GameSystemRankings_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "GameSystemRankings"
    ADD CONSTRAINT "GameSystemRankings_pkey" PRIMARY KEY (id);


--
-- Name: GameSystems_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "GameSystems"
    ADD CONSTRAINT "GameSystems_pkey" PRIMARY KEY (id);


--
-- Name: Manufacturers_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Manufacturers"
    ADD CONSTRAINT "Manufacturers_pkey" PRIMARY KEY (id);


--
-- Name: NewsPosts_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "NewsPosts"
    ADD CONSTRAINT "NewsPosts_pkey" PRIMARY KEY (id);


--
-- Name: ProductOrders_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "ProductOrders"
    ADD CONSTRAINT "ProductOrders_pkey" PRIMARY KEY (id);


--
-- Name: Products_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Products"
    ADD CONSTRAINT "Products_pkey" PRIMARY KEY (id);


--
-- Name: UserAchievements_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserAchievements"
    ADD CONSTRAINT "UserAchievements_pkey" PRIMARY KEY (id);


--
-- Name: UserMessages_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserMessages"
    ADD CONSTRAINT "UserMessages_pkey" PRIMARY KEY (id);


--
-- Name: UserNotifications_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserNotifications"
    ADD CONSTRAINT "UserNotifications_pkey" PRIMARY KEY (id);


--
-- Name: UserPhotos_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserPhotos"
    ADD CONSTRAINT "UserPhotos_pkey" PRIMARY KEY (id);


--
-- Name: UserRankings_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserRankings"
    ADD CONSTRAINT "UserRankings_pkey" PRIMARY KEY (id);


--
-- Name: Users_email_key; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_email_key" UNIQUE (email);


--
-- Name: Users_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_pkey" PRIMARY KEY (id);


--
-- Name: Users_username_key; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_username_key" UNIQUE (username);


--
-- Name: userHasFriends_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "userHasFriends"
    ADD CONSTRAINT "userHasFriends_pkey" PRIMARY KEY ("UserId", "FriendId");


--
-- Name: FactionRankings_FactionId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "FactionRankings"
    ADD CONSTRAINT "FactionRankings_FactionId_fkey" FOREIGN KEY ("FactionId") REFERENCES "Factions"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: FactionRankings_GameSystemRankingId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "FactionRankings"
    ADD CONSTRAINT "FactionRankings_GameSystemRankingId_fkey" FOREIGN KEY ("GameSystemRankingId") REFERENCES "GameSystemRankings"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Factions_GameSystemId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Factions"
    ADD CONSTRAINT "Factions_GameSystemId_fkey" FOREIGN KEY ("GameSystemId") REFERENCES "GameSystems"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: GameSystemRankings_GameSystemId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "GameSystemRankings"
    ADD CONSTRAINT "GameSystemRankings_GameSystemId_fkey" FOREIGN KEY ("GameSystemId") REFERENCES "GameSystems"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: GameSystemRankings_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "GameSystemRankings"
    ADD CONSTRAINT "GameSystemRankings_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: GameSystems_ManufacturerId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "GameSystems"
    ADD CONSTRAINT "GameSystems_ManufacturerId_fkey" FOREIGN KEY ("ManufacturerId") REFERENCES "Manufacturers"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: NewsPosts_FactionId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "NewsPosts"
    ADD CONSTRAINT "NewsPosts_FactionId_fkey" FOREIGN KEY ("FactionId") REFERENCES "Factions"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: NewsPosts_GameSystemId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "NewsPosts"
    ADD CONSTRAINT "NewsPosts_GameSystemId_fkey" FOREIGN KEY ("GameSystemId") REFERENCES "GameSystems"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: NewsPosts_ManufacturerId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "NewsPosts"
    ADD CONSTRAINT "NewsPosts_ManufacturerId_fkey" FOREIGN KEY ("ManufacturerId") REFERENCES "Manufacturers"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: NewsPosts_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "NewsPosts"
    ADD CONSTRAINT "NewsPosts_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: ProductOrders_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "ProductOrders"
    ADD CONSTRAINT "ProductOrders_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Products_FactionId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Products"
    ADD CONSTRAINT "Products_FactionId_fkey" FOREIGN KEY ("FactionId") REFERENCES "Factions"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Products_GameSystemId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Products"
    ADD CONSTRAINT "Products_GameSystemId_fkey" FOREIGN KEY ("GameSystemId") REFERENCES "GameSystems"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Products_ManufacturerId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Products"
    ADD CONSTRAINT "Products_ManufacturerId_fkey" FOREIGN KEY ("ManufacturerId") REFERENCES "Manufacturers"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: UserAchievements_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserAchievements"
    ADD CONSTRAINT "UserAchievements_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: UserMessages_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserMessages"
    ADD CONSTRAINT "UserMessages_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: UserNotifications_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserNotifications"
    ADD CONSTRAINT "UserNotifications_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: UserPhotos_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserPhotos"
    ADD CONSTRAINT "UserPhotos_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: UserRankings_FactionId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserRankings"
    ADD CONSTRAINT "UserRankings_FactionId_fkey" FOREIGN KEY ("FactionId") REFERENCES "Factions"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: UserRankings_GameSystemId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserRankings"
    ADD CONSTRAINT "UserRankings_GameSystemId_fkey" FOREIGN KEY ("GameSystemId") REFERENCES "GameSystems"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: UserRankings_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserRankings"
    ADD CONSTRAINT "UserRankings_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Users_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: userHasFriends_FriendId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "userHasFriends"
    ADD CONSTRAINT "userHasFriends_FriendId_fkey" FOREIGN KEY ("FriendId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: userHasFriends_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "userHasFriends"
    ADD CONSTRAINT "userHasFriends_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

