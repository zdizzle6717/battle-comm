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
-- Name: Achievements; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "Achievements" (
    id integer NOT NULL,
    title character varying(255),
    category character varying(255),
    description text,
    priority integer,
    "rpValue" integer,
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "GameSystemId" integer
);


ALTER TABLE "Achievements" OWNER TO bcadmin;

--
-- Name: Achievements_id_seq; Type: SEQUENCE; Schema: public; Owner: bcadmin
--

CREATE SEQUENCE "Achievements_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Achievements_id_seq" OWNER TO bcadmin;

--
-- Name: Achievements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bcadmin
--

ALTER SEQUENCE "Achievements_id_seq" OWNED BY "Achievements".id;


--
-- Name: BannerSlides; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "BannerSlides" (
    id integer NOT NULL,
    "actionText" character varying(255),
    title character varying(255),
    text text,
    link character varying(255),
    priority integer,
    "isActive" boolean,
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "pageName" character varying(255) DEFAULT 'home'::character varying
);


ALTER TABLE "BannerSlides" OWNER TO postgres;

--
-- Name: BannerSlides_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "BannerSlides_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "BannerSlides_id_seq" OWNER TO postgres;

--
-- Name: BannerSlides_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "BannerSlides_id_seq" OWNED BY "BannerSlides".id;


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
-- Name: Files; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Files" (
    id integer NOT NULL,
    "locationUrl" character varying(255),
    label character varying(255),
    name character varying(255),
    size integer,
    type character varying(255),
    identifier character varying(255) DEFAULT 'default'::character varying,
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "BannerSlideId" integer,
    "GameSystemId" integer,
    "ManufacturerId" integer,
    "NewsPostId" integer,
    "ProductId" integer,
    "UserId" integer,
    "UserAchievementId" integer,
    "AchievementId" integer
);


ALTER TABLE "Files" OWNER TO postgres;

--
-- Name: Files_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Files_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Files_id_seq" OWNER TO postgres;

--
-- Name: Files_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Files_id_seq" OWNED BY "Files".id;


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
    description text,
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
    "orderTotal" integer,
    "customerFullName" character varying(255),
    "customerEmail" character varying(255),
    phone character varying(255),
    "shippingStreet" character varying(255),
    "shippingApartment" character varying(255),
    "shippingCity" character varying(255),
    "shippingState" character varying(255),
    "shippingZip" character varying(255),
    "shippingCountry" character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer,
    "productDetails" jsonb,
    "orderDetails" text
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
    color character varying(255),
    tags character varying(255),
    category character varying(255),
    "stockQty" integer,
    "filterVal" character varying(255) DEFAULT 'showit'::character varying,
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "ManufacturerId" integer,
    "FactionId" integer,
    "GameSystemId" integer,
    "isDisplayed" boolean DEFAULT true,
    "isFeatured" boolean DEFAULT false,
    "isNew" boolean DEFAULT true,
    "isOnSale" boolean DEFAULT false,
    "shippingCost" double precision
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
    "UserId" integer,
    details character varying(255)
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
-- Name: UserPhotos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "UserPhotos" (
    id integer NOT NULL,
    "locationUrl" character varying(255),
    label character varying(255),
    name character varying(255),
    size integer,
    type character varying(255),
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer,
    identifier character varying(255)
);


ALTER TABLE "UserPhotos" OWNER TO postgres;

--
-- Name: UserPhotos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "UserPhotos_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "UserPhotos_id_seq" OWNER TO postgres;

--
-- Name: UserPhotos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
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
    bio text DEFAULT '...'::text,
    facebook character varying(255),
    twitter character varying(255),
    instagram character varying(255),
    "googlePlus" character varying(255),
    youtube character varying(255),
    twitch character varying(255),
    website character varying(255),
    "rewardPoints" integer DEFAULT 0,
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
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "UserId" integer,
    subscriber boolean DEFAULT false,
    "accountActivated" boolean DEFAULT false,
    "accountBlocked" boolean DEFAULT false,
    "customerId" character varying(255),
    "hasAuthenticatedOnce" boolean DEFAULT false,
    "rpPool" integer DEFAULT 0,
    "eventAdminSubscriber" boolean DEFAULT false
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
-- Name: userHasAchievements; Type: TABLE; Schema: public; Owner: bcadmin
--

CREATE TABLE "userHasAchievements" (
    "createdAt" timestamp with time zone NOT NULL,
    "updatedAt" timestamp with time zone NOT NULL,
    "AchievementId" integer NOT NULL,
    "UserId" integer NOT NULL
);


ALTER TABLE "userHasAchievements" OWNER TO bcadmin;

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

ALTER TABLE ONLY "Achievements" ALTER COLUMN id SET DEFAULT nextval('"Achievements_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "BannerSlides" ALTER COLUMN id SET DEFAULT nextval('"BannerSlides_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "FactionRankings" ALTER COLUMN id SET DEFAULT nextval('"FactionRankings_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Factions" ALTER COLUMN id SET DEFAULT nextval('"Factions_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Files" ALTER COLUMN id SET DEFAULT nextval('"Files_id_seq"'::regclass);


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
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
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
-- Data for Name: Achievements; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "Achievements" (id, title, category, description, priority, "rpValue", "createdAt", "updatedAt", "GameSystemId") FROM stdin;
1	Soldier	general	Become a Battle-Comm subscriber as a Solder	100	0	2017-05-14 23:29:58.244+00	2017-05-14 23:29:58.244+00	\N
2	Commander	general	Become a Battle-Comm subscriber as a General	100	0	2017-05-14 23:30:28.488+00	2017-05-14 23:30:28.488+00	\N
3	Marshal	general	Become a Battle-Comm subscriber as a Marshal	100	0	2017-05-14 23:31:52.301+00	2017-05-14 23:31:52.301+00	\N
4	Lord Marshal	general	Become a Battle-Comm subscriber as a Lord Marshal	100	0	2017-05-14 23:32:23.532+00	2017-05-14 23:38:15.884+00	\N
5	CoC Best Overall	40k Event	Earn Best Overall at a Great Escape Games Contest of Champions	100	0	2017-06-08 14:43:42.016+00	2017-06-08 14:43:42.016+00	\N
6	CoC Best General	40k Event	Earn Best General at a Great Escape Games Contest of Champions Event	100	0	2017-06-08 14:45:28.648+00	2017-06-08 14:45:28.648+00	\N
7	CoC Best Paint	40k Event	Earn Best Paint at a Great Escape Games Contest of Champions event	100	0	2017-06-08 14:46:32.725+00	2017-06-08 14:46:32.725+00	\N
8	CoC Best Sport	40k Event	Earn Best Sport at a Great Escape Games Contest of Champions Event.	100	0	2017-06-08 14:48:06.664+00	2017-06-08 14:48:06.664+00	\N
9	CoC Grot	40k Event	Earn Grot at a Great Escape Games Contest of Champions Event	100	0	2017-06-08 14:49:12.066+00	2017-06-08 14:49:12.066+00	\N
10	CoC Soldier	40k Event	Play in a Great Escape Games Contest of Champions Event.	100	0	2017-06-08 14:50:12.873+00	2017-06-08 14:50:12.873+00	\N
11	CoC Gladiator 	40k Event	Play in all Great Escape Games Contest of Champions events in a single season.	100	0	2017-06-08 14:51:42.48+00	2017-06-08 14:51:42.48+00	\N
12	CoC Top 3	40k Event	Finish in the top 3 Battle points at a Great Escape Games Contest of Champions Event 	100	0	2017-06-08 14:54:13.316+00	2017-06-08 14:54:13.316+00	\N
13	CoC Top 5	40k event	Place in the top 5 total Battle Points at a Great Escape Games Contest of Champions Event 	100	0	2017-06-08 14:55:49.512+00	2017-06-08 14:55:49.512+00	\N
14	CoC Top 10	40k Event	Place in the top 10 for total Battle points at a Great Escape Games Contest of Champions Event.	100	0	2017-06-08 14:57:07.34+00	2017-06-08 14:57:07.34+00	\N
15	Oldhammer Best General	40k Event	Earn Best General at a Meta Mafia Oldhammer event.	100	0	2017-06-08 15:01:32.224+00	2017-06-08 15:01:32.224+00	\N
16	Oldhammer Best Paint	40k Event	Earn Best Paint at a Meta Mafia Oldhammer event.	100	0	2017-06-08 15:02:27.679+00	2017-06-08 15:02:27.679+00	\N
17	Oldhammer Top 8	40k Event	Place in the top 8 for total Battle Points at a Meta Mafia Event.	100	0	2017-06-08 15:04:05.596+00	2017-06-08 15:04:05.596+00	\N
18	Oldhammer Wooden Bolter	40k Event	Earn Wooden Bolter at a Meta Mafia Oldhammer Event.	100	0	2017-06-08 15:05:12.543+00	2017-06-08 15:05:12.543+00	\N
19	Oldhammer Soldier	40k Event	Play in a Meta Mafia Oldhammer Event.	100	0	2017-06-08 15:06:06.41+00	2017-06-08 15:06:06.41+00	\N
20	Oldhammer Gladiator 	40k Event	Play in all Meta Mafia Oldhammer Events during a single season.	100	0	2017-06-08 15:07:00.419+00	2017-06-08 15:07:00.419+00	\N
21	Great Escape Games EventAdmin	EventAdmin	Run a table top game event for Great Escape Games	100	0	2017-06-16 14:42:38.676+00	2017-06-16 14:42:38.676+00	\N
\.


--
-- Name: Achievements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Achievements_id_seq"', 21, true);


--
-- Data for Name: BannerSlides; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "BannerSlides" (id, "actionText", title, text, link, priority, "isActive", "createdAt", "updatedAt", "pageName") FROM stdin;
6	Sign Up	Play, Compete, Earn	Battle-Comm is your new source for connection with the table-top gaming community. Play table-top at participating game shops, compete in tournaments, earn Reward Points, and exchange them for new merch.	/login	1	t	2017-04-23 17:49:43.333+00	2017-04-24 00:02:29.683+00	home
\.


--
-- Name: BannerSlides_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"BannerSlides_id_seq"', 15, true);


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
13	2	1	4	2017-04-20 00:59:27.2+00	2017-04-20 01:00:36.097+00	20	11
14	2	1	0	2017-06-24 20:47:50.584+00	2017-06-24 20:47:50.584+00	274	12
15	2	1	0	2017-06-24 20:51:08.712+00	2017-06-24 20:51:08.712+00	21	13
16	2	1	0	2017-06-24 20:51:51.52+00	2017-06-24 20:51:51.52+00	262	14
\.


--
-- Name: FactionRankings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"FactionRankings_id_seq"', 16, true);


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
40	Empire	2016-10-25 15:15:16.957+00	2016-10-25 15:15:16.957+00	18	\N
41	Rebels	2016-10-25 15:15:26.111+00	2016-10-25 15:15:26.111+00	18	\N
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
65	Space Marines: White Scars	2016-10-25 15:26:57.77+00	2016-10-25 15:26:57.77+00	22	\N
66	Space Marines: Salamanders	2016-10-25 15:27:13.095+00	2016-10-25 15:27:13.095+00	22	\N
67	Space Marines: Imperial Fists	2016-10-25 15:27:35.065+00	2016-10-25 15:27:35.065+00	22	\N
68	Space Marines: Raven Guard	2016-10-25 15:27:48.885+00	2016-10-25 15:27:48.885+00	22	\N
69	Space Marines: Space Wolves	2016-10-25 15:28:01.7+00	2016-10-25 15:28:01.7+00	22	\N
19	Test Factions	2016-10-18 22:25:47.121+00	2016-11-02 00:02:22.473+00	69	\N
70	UNSC	2016-11-05 01:38:11.59+00	2016-11-05 01:38:11.59+00	57	\N
71	Covenant	2016-11-05 01:38:30.758+00	2016-11-05 01:38:30.758+00	57	\N
79	Guild	2017-05-24 16:49:56.554+00	2017-05-24 16:49:56.554+00	69	\N
80	Ten Thunders	2017-05-24 16:50:12.023+00	2017-05-24 16:50:12.023+00	69	\N
81	Resurrectionists	2017-05-24 16:50:35.473+00	2017-05-24 16:50:35.473+00	69	\N
82	Arcanists	2017-05-24 16:50:51.346+00	2017-05-24 16:50:51.346+00	69	\N
83	Neverborn	2017-05-24 16:50:58.402+00	2017-05-24 16:50:58.402+00	69	\N
84	Outcasts	2017-05-24 16:51:12.725+00	2017-05-24 16:51:12.725+00	69	\N
85	Federation	2017-05-24 16:52:41.751+00	2017-05-24 16:52:41.751+00	68	\N
86	Klingon Empire	2017-05-24 16:52:59.461+00	2017-05-24 16:52:59.461+00	68	\N
87	Romulan Empire	2017-05-24 16:53:14.897+00	2017-05-24 16:53:14.897+00	68	\N
88	Borg	2017-05-24 16:53:21.401+00	2017-05-24 16:53:21.401+00	68	\N
89	Dominion	2017-05-24 16:53:35.717+00	2017-05-24 16:53:35.717+00	68	\N
90	Good	2017-05-24 16:54:11.145+00	2017-05-24 16:54:11.145+00	66	\N
91	Evil	2017-05-24 16:54:16.583+00	2017-05-24 16:54:16.583+00	66	\N
92	Algoryn	2017-05-24 16:55:17.126+00	2017-05-24 16:55:17.126+00	64	\N
93	Boromite	2017-05-24 16:55:27.49+00	2017-05-24 16:55:27.49+00	64	\N
94	Concord	2017-05-24 16:55:40.726+00	2017-05-24 16:55:40.726+00	64	\N
95	Mercenaries	2017-05-24 16:55:53.426+00	2017-05-24 16:55:53.426+00	64	\N
96	Epirian Foundation	2017-05-24 16:58:12.714+00	2017-05-24 16:58:12.714+00	58	\N
97	Karist Enclave	2017-05-24 16:58:27.752+00	2017-05-24 16:58:27.752+00	58	\N
98	Aquan Prime	2017-05-24 17:00:27.616+00	2017-05-24 17:00:27.616+00	55	\N
99	Dindrenzi Federation	2017-05-24 17:00:42.286+00	2017-05-24 17:00:42.286+00	55	\N
100	Sorylian Collective	2017-05-24 17:01:08.453+00	2017-05-24 17:01:08.453+00	55	\N
101	Terran Alliance	2017-05-24 17:01:19.019+00	2017-05-24 17:01:19.019+00	55	\N
102	The Directorate	2017-05-24 17:01:35.795+00	2017-05-24 17:01:35.795+00	55	\N
103	The Relthoza	2017-05-24 17:01:59.169+00	2017-05-24 17:01:59.169+00	55	\N
104	Aquan Prime	2017-05-24 17:02:50.476+00	2017-05-24 17:02:50.476+00	54	\N
105	Dindrenzi Federation	2017-05-24 17:03:09.559+00	2017-05-24 17:03:09.559+00	54	\N
106	Sorylian Collective	2017-05-24 17:03:26.648+00	2017-05-24 17:03:26.648+00	54	\N
107	Terran Alliance	2017-05-24 17:03:39.118+00	2017-05-24 17:03:39.118+00	54	\N
108	The Directorate	2017-05-24 17:03:57.594+00	2017-05-24 17:03:57.594+00	54	\N
109	The Relthoza	2017-05-24 17:04:07.116+00	2017-05-24 17:04:07.116+00	54	\N
110	Kurak Alliance	2017-05-24 17:04:16.147+00	2017-05-24 17:04:16.147+00	54	\N
111	Zenian League	2017-05-24 17:04:39.267+00	2017-05-24 17:04:39.267+00	54	\N
112	Empire of the Blazing Sun	2017-05-24 17:05:45.659+00	2017-05-24 17:05:45.659+00	53	\N
113	Federated States of America	2017-05-24 17:06:03.782+00	2017-05-24 17:06:03.782+00	53	\N
114	Kingdom of Birtannia	2017-05-24 17:06:23.579+00	2017-05-24 17:06:23.579+00	53	\N
115	Prussian Empire	2017-05-24 17:06:36.759+00	2017-05-24 17:06:36.759+00	53	\N
116	Covenant of Antarctica	2017-05-24 17:06:53.167+00	2017-05-24 17:06:53.167+00	53	\N
117	Russian Coalition	2017-05-24 17:07:12.11+00	2017-05-24 17:07:12.11+00	53	\N
118	Republique of France	2017-05-24 17:07:30.015+00	2017-05-24 17:07:30.015+00	53	\N
119	Australians	2017-05-24 17:07:50.174+00	2017-05-24 17:07:50.174+00	53	\N
120	Chinese Federation	2017-05-24 17:08:02.547+00	2017-05-24 17:08:02.547+00	53	\N
121	League of Italian States	2017-05-24 17:08:19.451+00	2017-05-24 17:08:19.451+00	53	\N
122	Ottoman Empire	2017-05-24 17:08:31.466+00	2017-05-24 17:08:31.466+00	53	\N
123	Polish-Lithuaniah Commonwealth	2017-05-24 17:09:03.062+00	2017-05-24 17:09:03.062+00	53	\N
124	Republic of Egypt	2017-05-24 17:09:22.99+00	2017-05-24 17:09:22.99+00	53	\N
125	Socialist Union of South America	2017-05-24 17:10:57.95+00	2017-05-24 17:10:57.95+00	53	\N
126	Empire of the Blazing Sun	2017-05-24 17:11:47.218+00	2017-05-24 17:11:47.218+00	52	\N
127	Federated States of America	2017-05-24 17:12:04.957+00	2017-05-24 17:12:04.957+00	52	\N
128	Kingdom of Birtannia	2017-05-24 17:12:20.289+00	2017-05-24 17:12:20.289+00	52	\N
129	Prussian Empire	2017-05-24 17:12:32.519+00	2017-05-24 17:12:32.519+00	52	\N
130	The Council	2017-05-24 17:13:57.332+00	2017-05-24 17:13:57.332+00	51	\N
131	Uruhvel	2017-05-24 17:14:07.851+00	2017-05-24 17:14:07.851+00	51	\N
132	Raiders of Saanar	2017-05-24 17:14:26.372+00	2017-05-24 17:14:26.372+00	51	\N
133	Sovereign Empire	2017-05-24 17:14:41.631+00	2017-05-24 17:14:41.631+00	51	\N
134	Guardians of Tanaor	2017-05-24 17:14:54.622+00	2017-05-24 17:14:54.622+00	51	\N
135	Mishima	2017-05-24 17:15:50.808+00	2017-05-24 17:15:50.808+00	50	\N
136	Cybertronic	2017-05-24 17:15:59.785+00	2017-05-24 17:15:59.785+00	50	\N
137	Imperial	2017-05-24 17:16:20.226+00	2017-05-24 17:16:20.226+00	50	\N
138	Dark Legion	2017-05-24 17:16:28.758+00	2017-05-24 17:16:28.758+00	50	\N
139	Capitol	2017-05-24 17:16:35.862+00	2017-05-24 17:16:35.862+00	50	\N
140	Brotherhood	2017-05-24 17:16:48.628+00	2017-05-24 17:16:48.628+00	50	\N
141	Bauhaus	2017-05-24 17:16:58.192+00	2017-05-24 17:16:58.192+00	50	\N
142	Cygnar	2017-05-24 17:17:45.056+00	2017-05-24 17:17:45.056+00	49	\N
143	Cryx	2017-05-24 17:17:51.584+00	2017-05-24 17:17:51.584+00	49	\N
144	Khador	2017-05-24 17:18:05.78+00	2017-05-24 17:18:05.78+00	49	\N
145	Retribution of Scyrah	2017-05-24 17:18:24.134+00	2017-05-24 17:18:24.134+00	49	\N
146	The Protectorate of Menoth	2017-05-24 17:18:39.917+00	2017-05-24 17:18:39.917+00	49	\N
147	Mercenaries	2017-05-24 17:18:53.185+00	2017-05-24 17:18:53.185+00	49	\N
148	Trollbloods	2017-05-24 17:18:59.974+00	2017-05-24 17:18:59.974+00	49	\N
149	Circle Orboros	2017-05-24 17:19:12.206+00	2017-05-24 17:19:12.206+00	49	\N
150	Skorne	2017-05-24 17:19:20.089+00	2017-05-24 17:19:20.089+00	49	\N
151	Legion of Everblight	2017-05-24 17:19:34.961+00	2017-05-24 17:19:34.961+00	49	\N
152	Minions	2017-05-24 17:19:41.611+00	2017-05-24 17:19:41.611+00	49	\N
153	Enlightened	2017-05-24 17:20:29.083+00	2017-05-24 17:20:29.083+00	47	\N
154	Lawmen	2017-05-24 17:20:36.276+00	2017-05-24 17:20:36.276+00	47	\N
155	Outlaws	2017-05-24 17:20:48.457+00	2017-05-24 17:20:48.457+00	47	\N
156	Union	2017-05-24 17:20:54.053+00	2017-05-24 17:20:54.053+00	47	\N
157	Warrior Nation	2017-05-24 17:21:01.171+00	2017-05-24 17:21:01.171+00	47	\N
158	Holy Order of Man	2017-05-24 17:21:14.61+00	2017-05-24 17:21:14.61+00	47	\N
159	Corporation	2017-05-24 17:22:10.276+00	2017-05-24 17:22:10.276+00	45	\N
160	Marauders	2017-05-24 17:22:20.926+00	2017-05-24 17:22:20.926+00	45	\N
161	Forge Fathers	2017-05-24 17:22:27.052+00	2017-05-24 17:22:27.052+00	45	\N
162	Enforcers	2017-05-24 17:22:40.553+00	2017-05-24 17:22:40.553+00	45	\N
163	Veer'myn	2017-05-24 17:23:00.684+00	2017-05-24 17:23:00.684+00	45	\N
164	Zombie Apokalypse	2017-05-24 17:23:17.663+00	2017-05-24 17:23:17.663+00	45	\N
165	UEDF	2017-05-24 17:24:15.549+00	2017-05-24 17:24:15.549+00	48	\N
166	Zentraedi	2017-05-24 17:24:30.198+00	2017-05-24 17:24:30.198+00	48	\N
167	Cweci Speed Circuit	2017-05-24 17:25:17.421+00	2017-05-24 17:25:17.421+00	46	\N
168	Shattered Sword Paladins	2017-05-24 17:25:33.182+00	2017-05-24 17:25:33.182+00	46	\N
169	Black Diamond	2017-05-24 17:25:47.133+00	2017-05-24 17:25:47.133+00	46	\N
170	Noh Empire	2017-05-24 17:25:56.257+00	2017-05-24 17:25:56.257+00	46	\N
171	Star Nebular Corsairs	2017-05-24 17:26:09.454+00	2017-05-24 17:26:09.454+00	46	\N
172	Doctrine	2017-05-24 17:26:24.317+00	2017-05-24 17:26:24.317+00	46	\N
173	Abyssal Dwarfs	2017-05-24 17:27:22.3+00	2017-05-24 17:27:22.3+00	44	\N
174	Dwarfs	2017-05-24 17:27:27.562+00	2017-05-24 17:27:27.562+00	44	\N
175	Goblins	2017-05-24 17:27:33.012+00	2017-05-24 17:27:33.012+00	44	\N
176	Ogres	2017-05-24 17:27:48.292+00	2017-05-24 17:27:48.292+00	44	\N
177	Orcs	2017-05-24 17:27:54.27+00	2017-05-24 17:27:54.27+00	44	\N
178	Undead	2017-05-24 17:27:59.432+00	2017-05-24 17:27:59.432+00	44	\N
179	Human	2017-05-24 17:28:56.174+00	2017-05-24 17:28:56.174+00	43	\N
180	Forge Father	2017-05-24 17:29:03.432+00	2017-05-24 17:29:03.432+00	43	\N
181	Veer-myn	2017-05-24 17:29:14.859+00	2017-05-24 17:29:14.859+00	43	\N
182	Marauders	2017-05-24 17:29:27.358+00	2017-05-24 17:29:27.358+00	43	\N
183	Female Corporation	2017-05-24 17:29:36.759+00	2017-05-24 17:29:36.759+00	43	\N
184	Judwan	2017-05-24 17:29:43.74+00	2017-05-24 17:29:43.74+00	43	\N
185	Robots	2017-05-24 17:29:49.931+00	2017-05-24 17:29:49.931+00	43	\N
186	Z'zor	2017-05-24 17:30:07.109+00	2017-05-24 17:30:07.109+00	43	\N
187	Enforcers	2017-05-24 17:30:54.413+00	2017-05-24 17:30:54.413+00	42	\N
188	Plague	2017-05-24 17:31:00.183+00	2017-05-24 17:31:00.183+00	42	\N
189	Rebels	2017-05-24 17:31:05.569+00	2017-05-24 17:31:05.569+00	42	\N
190	Marauders	2017-05-24 17:31:30.164+00	2017-05-24 17:31:30.164+00	42	\N
191	Forge Fathers	2017-05-24 17:31:40.033+00	2017-05-24 17:31:40.033+00	42	\N
192	Asterians	2017-05-24 17:31:49.931+00	2017-05-24 17:31:49.931+00	42	\N
193	UCM	2017-05-24 17:32:30.313+00	2017-05-24 17:32:30.313+00	41	\N
194	Scourge	2017-05-24 17:32:40.44+00	2017-05-24 17:32:40.44+00	41	\N
195	PHR	2017-05-24 17:32:53.672+00	2017-05-24 17:32:53.672+00	41	\N
196	Shaltari	2017-05-24 17:33:01.804+00	2017-05-24 17:33:01.804+00	41	\N
197	Resistance	2017-05-24 17:33:08.419+00	2017-05-24 17:33:08.419+00	41	\N
198	UCM	2017-05-24 17:33:48.365+00	2017-05-24 17:33:48.365+00	40	\N
199	Scourge	2017-05-24 17:33:54.242+00	2017-05-24 17:33:54.242+00	40	\N
200	PHR	2017-05-24 17:33:59.765+00	2017-05-24 17:33:59.765+00	40	\N
201	Shaltari	2017-05-24 17:34:05.879+00	2017-05-24 17:34:05.879+00	40	\N
202	Resistance	2017-05-24 17:34:12.003+00	2017-05-24 17:34:12.003+00	40	\N
203	Prefecture of Ryu	2017-05-24 17:38:54.18+00	2017-05-24 17:38:54.18+00	39	\N
204	Temple of Ro-Kan	2017-05-24 17:39:09.143+00	2017-05-24 17:39:09.143+00	39	\N
205	The Cult of Yurei	2017-05-24 17:39:35.716+00	2017-05-24 17:39:35.716+00	39	\N
206	The Savage Wave	2017-05-24 17:39:45.029+00	2017-05-24 17:39:45.029+00	39	\N
207	The Ito Clan	2017-05-24 17:39:54.86+00	2017-05-24 17:39:54.86+00	39	\N
208	Silvermoon Trade Syndicate	2017-05-24 17:40:15.51+00	2017-05-24 17:40:15.51+00	39	\N
209	Tengu Descension	2017-05-24 17:40:26.621+00	2017-05-24 17:40:26.621+00	39	\N
210	Good	2017-05-24 17:41:46.227+00	2017-05-24 17:41:46.227+00	23	\N
211	Evil	2017-05-24 17:41:50.905+00	2017-05-24 17:41:50.905+00	23	\N
212	Scum and Villiany	2017-05-24 17:43:13.607+00	2017-05-24 17:43:13.607+00	18	\N
213	Light Side	2017-05-24 17:44:03.153+00	2017-05-24 17:44:03.153+00	17	\N
214	Dark Side	2017-05-24 17:44:08.513+00	2017-05-24 17:44:08.513+00	17	\N
215	Rebel	2017-05-24 17:44:47.363+00	2017-05-24 17:44:47.363+00	16	\N
216	Imperial	2017-05-24 17:44:54.229+00	2017-05-24 17:44:54.229+00	16	\N
217	Corporation	2017-05-24 17:45:36.69+00	2017-05-24 17:45:36.69+00	15	\N
218	Runner	2017-05-24 17:45:42.306+00	2017-05-24 17:45:42.306+00	15	\N
219	House Martell	2017-05-24 17:46:41.03+00	2017-05-24 17:46:41.03+00	14	\N
220	House Stark	2017-05-24 17:46:49.715+00	2017-05-24 17:46:49.715+00	14	\N
221	House Baratheon	2017-05-24 17:46:58.744+00	2017-05-24 17:46:58.744+00	14	\N
222	House Targaryen	2017-05-24 17:47:17.788+00	2017-05-24 17:47:17.788+00	14	\N
223	House Lanister	2017-05-24 17:47:27.339+00	2017-05-24 17:47:27.339+00	14	\N
224	House Greyjoy	2017-05-24 17:47:35.248+00	2017-05-24 17:47:35.248+00	14	\N
225	The Agency	2017-05-24 17:48:55.99+00	2017-05-24 17:48:55.99+00	13	\N
226	Miskatonic University	2017-05-24 17:49:07.844+00	2017-05-24 17:49:07.844+00	13	\N
227	The Syndicate	2017-05-24 17:49:15.316+00	2017-05-24 17:49:15.316+00	13	\N
228	Cthulhu	2017-05-24 17:49:34.752+00	2017-05-24 17:49:34.752+00	13	\N
229	Hastur	2017-05-24 17:49:40.02+00	2017-05-24 17:49:40.02+00	13	\N
230	Yog-Sothoth	2017-05-24 17:49:52.399+00	2017-05-24 17:49:52.399+00	13	\N
231	Shub-Niggurath	2017-05-24 17:50:04.48+00	2017-05-24 17:50:04.48+00	13	\N
232	Brood	2017-05-24 17:51:26.065+00	2017-05-24 17:51:26.065+00	10	\N
233	Core	2017-05-24 17:51:30.816+00	2017-05-24 17:51:30.816+00	10	\N
234	Dragyri	2017-05-24 17:51:39.188+00	2017-05-24 17:51:39.188+00	10	\N
235	Forsaken	2017-05-24 17:51:52.454+00	2017-05-24 17:51:52.454+00	10	\N
236	Kukulkani	2017-05-24 17:52:03.644+00	2017-05-24 17:52:03.644+00	10	\N
237	Outcast	2017-05-24 17:52:09.629+00	2017-05-24 17:52:09.629+00	10	\N
238	Bounty Hunters	2017-05-24 17:52:16.027+00	2017-05-24 17:52:16.027+00	10	\N
239	Skarrd	2017-05-24 17:52:25.757+00	2017-05-24 17:52:25.757+00	10	\N
240	Panoceania	2017-05-24 17:53:23.168+00	2017-05-24 17:53:23.168+00	9	\N
241	Yu Jing	2017-05-24 17:53:30.014+00	2017-05-24 17:53:30.014+00	9	\N
242	Ariadna	2017-05-24 17:53:37.7+00	2017-05-24 17:53:37.7+00	9	\N
243	Haqqislam	2017-05-24 17:54:03.262+00	2017-05-24 17:54:03.262+00	9	\N
244	Nomads	2017-05-24 17:54:09.197+00	2017-05-24 17:54:09.197+00	9	\N
245	Combined Army	2017-05-24 17:54:18.344+00	2017-05-24 17:54:18.344+00	9	\N
246	Aleph	2017-05-24 17:54:23.536+00	2017-05-24 17:54:23.536+00	9	\N
247	Tohaa	2017-05-24 17:54:34.623+00	2017-05-24 17:54:34.623+00	9	\N
248	Empire	2017-05-24 18:04:57.872+00	2017-05-24 18:04:57.872+00	7	\N
249	Azur Alliance	2017-05-24 18:05:08.967+00	2017-05-24 18:05:08.967+00	7	\N
250	Church	2017-05-24 18:05:20.458+00	2017-05-24 18:05:20.458+00	7	\N
251	Black Sun	2017-05-24 18:05:30.211+00	2017-05-24 18:05:30.211+00	7	\N
252	Wissenschaft	2017-05-24 18:05:40.843+00	2017-05-24 18:05:40.843+00	7	\N
253	Samael	2017-05-24 18:05:49.751+00	2017-05-24 18:05:49.751+00	7	\N
254	Wanderers and Summons	2017-05-24 18:06:11.249+00	2017-05-24 18:06:11.249+00	7	\N
255	Tau Empire	2017-05-24 18:11:03.17+00	2017-05-24 18:11:03.17+00	22	\N
256	Orks	2017-05-24 18:11:07.993+00	2017-05-24 18:11:07.993+00	22	\N
257	Tyranids	2017-05-24 18:11:14.596+00	2017-05-24 18:11:14.596+00	22	\N
258	Dark Eldar	2017-05-24 18:11:23.223+00	2017-05-24 18:11:23.223+00	22	\N
259	Adeptus Mechanicus	2017-05-24 18:11:52.485+00	2017-05-24 18:11:52.485+00	22	\N
260	Adepta Sororitas	2017-05-24 18:12:05.289+00	2017-05-24 18:12:05.289+00	22	\N
261	Astra Militarum	2017-05-24 18:12:37.478+00	2017-05-24 18:12:37.478+00	22	\N
262	Chaos Daemons	2017-05-24 18:12:50.159+00	2017-05-24 18:12:50.159+00	22	\N
263	Chaos Space Marines	2017-05-24 18:12:58.423+00	2017-05-24 18:12:58.423+00	22	\N
264	Grey Knights	2017-05-24 18:13:18.607+00	2017-05-24 18:13:18.607+00	22	\N
265	Space Marines: General	2017-05-24 18:13:29.448+00	2017-05-24 18:13:29.448+00	22	\N
266	Imperial Knights	2017-05-24 18:13:43.881+00	2017-05-24 18:13:43.881+00	22	\N
267	Inquisition	2017-05-24 18:13:52.895+00	2017-05-24 18:13:52.895+00	22	\N
268	Harlequins	2017-05-24 18:14:01.224+00	2017-05-24 18:14:01.224+00	22	\N
269	Officion Assassianorum	2017-05-24 18:14:27.445+00	2017-05-24 18:14:27.445+00	22	\N
270	Grand Alliance of Order	2017-05-24 18:29:06.33+00	2017-05-24 18:29:06.33+00	25	\N
271	Grand Alliance of Chaos	2017-05-24 18:29:19.733+00	2017-05-24 18:29:19.733+00	25	\N
272	Grand Alliance of Destruction	2017-05-24 18:29:31.038+00	2017-05-24 18:29:31.038+00	25	\N
273	Grand Alliance of Death	2017-05-24 18:29:39.437+00	2017-05-24 18:29:39.437+00	25	\N
274	Necrons	2017-06-24 20:47:02.528+00	2017-06-24 20:47:02.528+00	22	\N
\.


--
-- Name: Factions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Factions_id_seq"', 274, true);


--
-- Data for Name: Files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Files" (id, "locationUrl", label, name, size, type, identifier, "createdAt", "updatedAt", "BannerSlideId", "GameSystemId", "ManufacturerId", "NewsPostId", "ProductId", "UserId", "UserAchievementId", "AchievementId") FROM stdin;
54	banner/	\N	plaque.png	103462	image/png	bannerImage	2017-04-24 02:02:18.609+00	2017-04-24 02:02:18.609+00	15	\N	\N	\N	\N	\N	\N	\N
14	/players/81/photoStream/	\N	warhammer.png	2192931	image/png	photoStream	2017-04-15 16:07:12.006+00	2017-04-15 16:07:12.006+00	\N	\N	\N	\N	\N	81	\N	\N
29	manufacturers/	\N	default.jpg	59649	image/jpeg	manufacturerPhoto	2017-04-21 00:48:18.417+00	2017-04-21 00:48:18.417+00	\N	\N	\N	\N	\N	\N	\N	\N
33	gameSystems/	\N	icon.png	147098	image/png	gameSystemPhoto	2017-04-22 18:30:28.398+00	2017-04-22 18:30:28.398+00	\N	\N	\N	\N	\N	\N	\N	\N
41	news/2016/10/	\N	plaque.png	103462	image/png	newsPostPhoto	2017-04-22 19:32:36.127+00	2017-04-22 19:32:36.127+00	\N	\N	\N	1	\N	\N	\N	\N
42	news/2017/4/	\N	icon.png	147098	image/png	newsPostPhoto	2017-04-22 19:46:38.106+00	2017-04-22 19:46:38.106+00	\N	\N	\N	\N	\N	\N	\N	\N
43	news/2017/4/	\N	icon.png	147098	image/png	newsPostPhoto	2017-04-22 19:55:38.887+00	2017-04-22 19:55:38.887+00	\N	\N	\N	\N	\N	\N	\N	\N
44	banner/	\N	plaque.png	103462	image/png	bannerImage	2017-04-23 17:44:00.841+00	2017-04-23 17:44:00.841+00	5	\N	\N	\N	\N	\N	\N	\N
45	banner/	\N	logo.png	220055	image/png	bannerImage	2017-04-23 17:49:43.385+00	2017-04-23 17:49:43.385+00	6	\N	\N	\N	\N	\N	\N	\N
46	banner/	\N	icon.png	147098	image/png	bannerImage	2017-04-24 00:04:08.588+00	2017-04-24 00:04:08.588+00	7	\N	\N	\N	\N	\N	\N	\N
47	banner/	\N	icon.png	147098	image/png	bannerImage	2017-04-24 00:12:25.73+00	2017-04-24 00:12:25.73+00	8	\N	\N	\N	\N	\N	\N	\N
48	banner/	\N	icon.png	147098	image/png	bannerImage	2017-04-24 00:30:58.307+00	2017-04-24 00:30:58.307+00	9	\N	\N	\N	\N	\N	\N	\N
53	banner/	\N	icon.png	147098	image/png	bannerImage	2017-04-24 02:01:54.301+00	2017-04-24 02:01:54.301+00	15	\N	\N	\N	\N	\N	\N	\N
67	news/2017/5/	\N	icon.jpg	293983	image/jpeg	newsPostPhoto	2017-05-06 18:25:24.78+00	2017-05-06 18:25:24.78+00	\N	\N	\N	\N	\N	\N	\N	\N
68	/players/85/photoStream/	\N	20-Gorgeous-Backyard-Patio-Designs-and-Ideas-20.jpg	113033	image/jpeg	photoStream	2017-05-08 14:33:29.349+00	2017-05-08 14:33:29.349+00	\N	\N	\N	\N	\N	85	\N	\N
24	rpstore/0000001/	\N	default.jpg	59649	image/jpeg	productPhotoFront	2017-04-19 00:50:24.689+00	2017-04-19 00:50:24.689+00	\N	\N	\N	\N	\N	\N	\N	\N
25	rpstore/0000001/	\N	default.jpg	59649	image/jpeg	productPhotoBack	2017-04-19 00:50:24.691+00	2017-04-19 00:50:24.691+00	\N	\N	\N	\N	\N	\N	\N	\N
62	rpstore/fdsa/	\N	product-test.jpeg	269691	image/jpeg	productPhotoFront	2017-04-29 15:23:50.31+00	2017-04-29 15:23:50.31+00	\N	\N	\N	\N	\N	\N	\N	\N
63	rpstore/fdsa/	\N	product-test.jpeg	269691	image/jpeg	productPhotoBack	2017-04-29 15:23:50.318+00	2017-04-29 15:23:50.318+00	\N	\N	\N	\N	\N	\N	\N	\N
60	rpstore/abcd/	\N	Prints.jpg	529001	image/jpeg	productPhotoFront	2017-04-29 15:23:10.813+00	2017-04-29 15:23:10.813+00	\N	\N	\N	\N	\N	\N	\N	\N
61	rpstore/abcd/	\N	Prints.jpg	529001	image/jpeg	productPhotoBack	2017-04-29 15:23:10.818+00	2017-04-29 15:23:10.818+00	\N	\N	\N	\N	\N	\N	\N	\N
65	rpstore/fdas/	\N	prints2.jpg	218510	image/jpeg	productPhotoFront	2017-05-05 11:54:47.754+00	2017-05-05 11:54:47.754+00	\N	\N	\N	\N	\N	\N	\N	\N
66	rpstore/fdas/	\N	prints2.jpg	218510	image/jpeg	productPhotoBack	2017-05-05 11:54:47.76+00	2017-05-05 11:54:47.76+00	\N	\N	\N	\N	\N	\N	\N	\N
87	rpstore/FFGYT2400/	\N	FFGYT2400.png	169698	image/png	productPhotoFront	2017-05-16 22:23:16.249+00	2017-05-16 22:23:16.249+00	\N	\N	\N	\N	11	\N	\N	\N
88	rpstore/FFGYT2400/	\N	FFGYT2400.png	169698	image/png	productPhotoBack	2017-05-16 22:23:16.258+00	2017-05-16 22:23:16.258+00	\N	\N	\N	\N	11	\N	\N	\N
96	rpstore/FFGEwing/	\N	FFGEwing.jpg	58198	image/jpeg	productPhotoFront	2017-05-16 22:30:43.71+00	2017-05-16 22:30:43.71+00	\N	\N	\N	\N	8	\N	\N	\N
97	rpstore/FFGEwing/	\N	FFGEwing.jpg	58198	image/jpeg	productPhotoBack	2017-05-16 22:30:43.718+00	2017-05-16 22:30:43.718+00	\N	\N	\N	\N	8	\N	\N	\N
100	rpstore/FFGXwing/	\N	IMG_1094.PNG	89860	image/png	productPhotoBack	2017-05-16 23:55:07.169+00	2017-05-16 23:55:07.169+00	\N	\N	\N	\N	13	\N	\N	\N
101	rpstore/FFGXwing/	\N	IMG_1094.PNG	89860	image/png	productPhotoFront	2017-05-16 23:55:07.339+00	2017-05-16 23:55:07.339+00	\N	\N	\N	\N	13	\N	\N	\N
102	rpstore/FFGKWing/	\N	IMG_1118.PNG	100878	image/png	productPhotoFront	2017-05-17 00:02:17.869+00	2017-05-17 00:02:17.869+00	\N	\N	\N	\N	10	\N	\N	\N
103	rpstore/FFGKWing/	\N	IMG_1118.PNG	100878	image/png	productPhotoBack	2017-05-17 00:02:18.098+00	2017-05-17 00:02:18.098+00	\N	\N	\N	\N	10	\N	\N	\N
104	rpstore/FFGInquisitorTieFigher/	\N	IMG_1123.PNG	101619	image/png	productPhotoFront	2017-05-17 00:03:44.896+00	2017-05-17 00:03:44.896+00	\N	\N	\N	\N	9	\N	\N	\N
105	rpstore/FFGInquisitorTieFigher/	\N	IMG_1123.PNG	101619	image/png	productPhotoBack	2017-05-17 00:03:45.1+00	2017-05-17 00:03:45.1+00	\N	\N	\N	\N	9	\N	\N	\N
106	rpstore/FFGTieFighterExpansionPack/	\N	IMG_1095.PNG	89646	image/png	productPhotoBack	2017-05-17 00:06:53.524+00	2017-05-17 00:06:53.524+00	\N	\N	\N	\N	14	\N	\N	\N
107	rpstore/FFGTieFighterExpansionPack/	\N	IMG_1095.PNG	89646	image/png	productPhotoFront	2017-05-17 00:06:53.685+00	2017-05-17 00:06:53.685+00	\N	\N	\N	\N	14	\N	\N	\N
108	rpstore/FFGYwingExpansionPack/	\N	IMG_1096.PNG	93960	image/png	productPhotoFront	2017-05-17 00:11:03.467+00	2017-05-17 00:11:03.467+00	\N	\N	\N	\N	15	\N	\N	\N
109	rpstore/FFGYwingExpansionPack/	\N	IMG_1096.PNG	93960	image/png	productPhotoBack	2017-05-17 00:11:03.657+00	2017-05-17 00:11:03.657+00	\N	\N	\N	\N	15	\N	\N	\N
110	rpstore/FFGTieAdvancedExpansionPack/	\N	IMG_1097.PNG	89558	image/png	productPhotoFront	2017-05-17 00:14:16.163+00	2017-05-17 00:14:16.163+00	\N	\N	\N	\N	16	\N	\N	\N
111	rpstore/FFGTieAdvancedExpansionPack/	\N	IMG_1097.PNG	89558	image/png	productPhotoBack	2017-05-17 00:14:16.338+00	2017-05-17 00:14:16.338+00	\N	\N	\N	\N	16	\N	\N	\N
112	rpstore/FFGMillenniumFalconExpansionPack/	\N	IMG_1098.PNG	172522	image/png	productPhotoFront	2017-05-17 00:18:52.601+00	2017-05-17 00:18:52.601+00	\N	\N	\N	\N	17	\N	\N	\N
113	rpstore/FFGMillenniumFalconExpansionPack/	\N	IMG_1098.PNG	172522	image/png	productPhotoBack	2017-05-17 00:18:52.771+00	2017-05-17 00:18:52.771+00	\N	\N	\N	\N	17	\N	\N	\N
114	rpstore/FFGSlaveOneExpansionPack/	\N	IMG_1099.PNG	151493	image/png	productPhotoFront	2017-05-17 00:21:49.027+00	2017-05-17 00:21:49.027+00	\N	\N	\N	\N	18	\N	\N	\N
115	rpstore/FFGSlaveOneExpansionPack/	\N	IMG_1099.PNG	151493	image/png	productPhotoBack	2017-05-17 00:21:49.157+00	2017-05-17 00:21:49.157+00	\N	\N	\N	\N	18	\N	\N	\N
116	rpstore/FFGAwingExpansionPack/	\N	IMG_1100.PNG	96883	image/png	productPhotoFront	2017-05-17 00:24:26.297+00	2017-05-17 00:24:26.297+00	\N	\N	\N	\N	19	\N	\N	\N
117	rpstore/FFGAwingExpansionPack/	\N	IMG_1100.PNG	96883	image/png	productPhotoBack	2017-05-17 00:24:26.488+00	2017-05-17 00:24:26.488+00	\N	\N	\N	\N	19	\N	\N	\N
118	rpstore/FFGBwingExpansionPack/	\N	IMG_1104.PNG	88561	image/png	productPhotoFront	2017-05-17 00:26:59.114+00	2017-05-17 00:26:59.114+00	\N	\N	\N	\N	20	\N	\N	\N
119	rpstore/FFGBwingExpansionPack/	\N	IMG_1104.PNG	88561	image/png	productPhotoBack	2017-05-17 00:26:59.281+00	2017-05-17 00:26:59.281+00	\N	\N	\N	\N	20	\N	\N	\N
120	rpstore/FFGTieInterceptorExpansionPack/	\N	IMG_1101.PNG	100159	image/png	productPhotoFront	2017-05-17 00:30:06.129+00	2017-05-17 00:30:06.129+00	\N	\N	\N	\N	21	\N	\N	\N
121	rpstore/FFGTieInterceptorExpansionPack/	\N	IMG_1101.PNG	100159	image/png	productPhotoBack	2017-05-17 00:30:06.306+00	2017-05-17 00:30:06.306+00	\N	\N	\N	\N	21	\N	\N	\N
122	rpstore/FFGHWK290ExpansionPack/	\N	IMG_1102.PNG	92608	image/png	productPhotoFront	2017-05-17 00:34:19.099+00	2017-05-17 00:34:19.099+00	\N	\N	\N	\N	22	\N	\N	\N
123	rpstore/FFGHWK290ExpansionPack/	\N	IMG_1102.PNG	92608	image/png	productPhotoBack	2017-05-17 00:34:19.274+00	2017-05-17 00:34:19.274+00	\N	\N	\N	\N	22	\N	\N	\N
124	rpstore/FFGLambdaClassShuttleExpansionPack/	\N	IMG_1103.PNG	145149	image/png	productPhotoFront	2017-05-17 00:37:47.806+00	2017-05-17 00:37:47.806+00	\N	\N	\N	\N	23	\N	\N	\N
125	rpstore/FFGLambdaClassShuttleExpansionPack/	\N	IMG_1103.PNG	145149	image/png	productPhotoBack	2017-05-17 00:37:47.981+00	2017-05-17 00:37:47.981+00	\N	\N	\N	\N	23	\N	\N	\N
126	rpstore/FFGTieBomberExpansionPack/	\N	IMG_1105.PNG	88870	image/png	productPhotoFront	2017-05-17 00:40:43.758+00	2017-05-17 00:40:43.758+00	\N	\N	\N	\N	24	\N	\N	\N
64	news/2017/4/	\N	logo.png	220055	image/png	newsPostPhoto	2017-04-29 15:32:11.21+00	2017-04-29 15:32:11.21+00	\N	\N	\N	\N	\N	\N	\N	\N
127	rpstore/FFGTieBomberExpansionPack/	\N	IMG_1105.PNG	88870	image/png	productPhotoBack	2017-05-17 00:40:43.912+00	2017-05-17 00:40:43.912+00	\N	\N	\N	\N	24	\N	\N	\N
128	rpstore/FFGTieDefenderExpansionPack/	\N	IMG_1107.PNG	86724	image/png	productPhotoFront	2017-05-17 00:44:33.706+00	2017-05-17 00:44:33.706+00	\N	\N	\N	\N	25	\N	\N	\N
129	rpstore/FFGTieDefenderExpansionPack/	\N	IMG_1107.PNG	86724	image/png	productPhotoBack	2017-05-17 00:44:33.883+00	2017-05-17 00:44:33.883+00	\N	\N	\N	\N	25	\N	\N	\N
130	rpstore/FFGZ95HeadhunterExpansionPack/	\N	IMG_1106.PNG	88697	image/png	productPhotoBack	2017-05-17 01:11:42.118+00	2017-05-17 01:11:42.118+00	\N	\N	\N	\N	26	\N	\N	\N
131	rpstore/FFGZ95HeadhunterExpansionPack/	\N	IMG_1106.PNG	88697	image/png	productPhotoFront	2017-05-17 01:11:42.272+00	2017-05-17 01:11:42.272+00	\N	\N	\N	\N	26	\N	\N	\N
132	rpstore/FFGTiePhantomExpansionPack/	\N	IMG_1109.PNG	86405	image/png	productPhotoFront	2017-05-17 01:13:47.746+00	2017-05-17 01:13:47.746+00	\N	\N	\N	\N	27	\N	\N	\N
133	rpstore/FFGTiePhantomExpansionPack/	\N	IMG_1109.PNG	86405	image/png	productPhotoBack	2017-05-17 01:13:47.917+00	2017-05-17 01:13:47.917+00	\N	\N	\N	\N	27	\N	\N	\N
134	rpstore/FFGVT49DecimatorExpansionPack/	\N	IMG_1111.PNG	143841	image/png	productPhotoFront	2017-05-17 01:18:25.238+00	2017-05-17 01:18:25.238+00	\N	\N	\N	\N	28	\N	\N	\N
135	rpstore/FFGVT49DecimatorExpansionPack/	\N	IMG_1111.PNG	143841	image/png	productPhotoBack	2017-05-17 01:18:25.477+00	2017-05-17 01:18:25.477+00	\N	\N	\N	\N	28	\N	\N	\N
136	rpstore/FFGStarViperExpansionPack/	\N	IMG_1112.PNG	100556	image/png	productPhotoBack	2017-05-17 01:21:44.124+00	2017-05-17 01:21:44.124+00	\N	\N	\N	\N	29	\N	\N	\N
137	rpstore/FFGStarViperExpansionPack/	\N	IMG_1112.PNG	100556	image/png	productPhotoFront	2017-05-17 01:21:44.371+00	2017-05-17 01:21:44.371+00	\N	\N	\N	\N	29	\N	\N	\N
138	rpstore/FFGIG2000ExpansionPack/	\N	IMG_1113.PNG	159651	image/png	productPhotoFront	2017-05-17 01:24:37.654+00	2017-05-17 01:24:37.654+00	\N	\N	\N	\N	30	\N	\N	\N
139	rpstore/FFGIG2000ExpansionPack/	\N	IMG_1113.PNG	159651	image/png	productPhotoBack	2017-05-17 01:24:37.825+00	2017-05-17 01:24:37.825+00	\N	\N	\N	\N	30	\N	\N	\N
140	rpstore/FFGMostWantedExpansionPack/	\N	IMG_1114.PNG	141055	image/png	productPhotoFront	2017-05-17 01:27:27.72+00	2017-05-17 01:27:27.72+00	\N	\N	\N	\N	31	\N	\N	\N
141	rpstore/FFGMostWantedExpansionPack/	\N	IMG_1114.PNG	141055	image/png	productPhotoBack	2017-05-17 01:27:27.887+00	2017-05-17 01:27:27.887+00	\N	\N	\N	\N	31	\N	\N	\N
142	rpstore/FFGM3AInterceptorExpansionPack/	\N	IMG_1115.PNG	101526	image/png	productPhotoFront	2017-05-17 01:30:34.914+00	2017-05-17 01:30:34.914+00	\N	\N	\N	\N	32	\N	\N	\N
143	rpstore/FFGM3AInterceptorExpansionPack/	\N	IMG_1115.PNG	101526	image/png	productPhotoBack	2017-05-17 01:30:35.123+00	2017-05-17 01:30:35.123+00	\N	\N	\N	\N	32	\N	\N	\N
144	rpstore/FFGHoundsToothExpansionPack/	\N	IMG_1116.PNG	144313	image/png	productPhotoFront	2017-05-17 01:34:25.762+00	2017-05-17 01:34:25.762+00	\N	\N	\N	\N	33	\N	\N	\N
145	rpstore/FFGHoundsToothExpansionPack/	\N	IMG_1116.PNG	144313	image/png	productPhotoBack	2017-05-17 01:34:25.932+00	2017-05-17 01:34:25.932+00	\N	\N	\N	\N	33	\N	\N	\N
146	rpstore/FFGTiePunisherExpansionPack/	\N	IMG_1119.PNG	89837	image/png	productPhotoFront	2017-05-17 01:37:30.462+00	2017-05-17 01:37:30.462+00	\N	\N	\N	\N	34	\N	\N	\N
147	rpstore/FFGTiePunisherExpansionPack/	\N	IMG_1119.PNG	89837	image/png	productPhotoBack	2017-05-17 01:37:30.64+00	2017-05-17 01:37:30.64+00	\N	\N	\N	\N	34	\N	\N	\N
148	rpstore/FFGKihraxzFighterExpansionPack/	\N	IMG_1117.PNG	97590	image/png	productPhotoFront	2017-05-17 01:40:15.482+00	2017-05-17 01:40:15.482+00	\N	\N	\N	\N	35	\N	\N	\N
149	rpstore/FFGKihraxzFighterExpansionPack/	\N	IMG_1117.PNG	97590	image/png	productPhotoBack	2017-05-17 01:40:15.658+00	2017-05-17 01:40:15.658+00	\N	\N	\N	\N	35	\N	\N	\N
150	rpstore/FFGT70XwingExpansionPack/	\N	IMG_1120.PNG	94801	image/png	productPhotoFront	2017-05-17 01:43:28.968+00	2017-05-17 01:43:28.968+00	\N	\N	\N	\N	36	\N	\N	\N
151	rpstore/FFGT70XwingExpansionPack/	\N	IMG_1120.PNG	94801	image/png	productPhotoBack	2017-05-17 01:43:29.141+00	2017-05-17 01:43:29.141+00	\N	\N	\N	\N	36	\N	\N	\N
152	rpstore/FFGTieFoFighterExpansionPack/	\N	IMG_1121.PNG	94298	image/png	productPhotoBack	2017-05-17 01:46:41.372+00	2017-05-17 01:46:41.372+00	\N	\N	\N	\N	37	\N	\N	\N
153	rpstore/FFGTieFoFighterExpansionPack/	\N	IMG_1121.PNG	94298	image/png	productPhotoFront	2017-05-17 01:46:41.548+00	2017-05-17 01:46:41.548+00	\N	\N	\N	\N	37	\N	\N	\N
154	rpstore/FFGGhostExpansionPack/	\N	IMG_1122.PNG	154903	image/png	productPhotoFront	2017-05-17 01:49:44.792+00	2017-05-17 01:49:44.792+00	\N	\N	\N	\N	38	\N	\N	\N
155	rpstore/FFGGhostExpansionPack/	\N	IMG_1122.PNG	154903	image/png	productPhotoBack	2017-05-17 01:49:44.962+00	2017-05-17 01:49:44.962+00	\N	\N	\N	\N	38	\N	\N	\N
156	rpstore/FFGMistHunterExpansionPack/	\N	IMG_1124.PNG	99172	image/png	productPhotoFront	2017-05-17 01:52:22.923+00	2017-05-17 01:52:22.923+00	\N	\N	\N	\N	39	\N	\N	\N
157	rpstore/FFGMistHunterExpansionPack/	\N	IMG_1124.PNG	99172	image/png	productPhotoBack	2017-05-17 01:52:23.093+00	2017-05-17 01:52:23.093+00	\N	\N	\N	\N	39	\N	\N	\N
158	rpstore/FFGPunishingOneExpansionPack/	\N	IMG_1125.PNG	162565	image/png	productPhotoFront	2017-05-17 01:54:53.268+00	2017-05-17 01:54:53.268+00	\N	\N	\N	\N	40	\N	\N	\N
159	rpstore/FFGPunishingOneExpansionPack/	\N	IMG_1125.PNG	162565	image/png	productPhotoBack	2017-05-17 01:54:53.433+00	2017-05-17 01:54:53.433+00	\N	\N	\N	\N	40	\N	\N	\N
160	rpstore/FFGARC170ExpansionPack/	\N	IMG_1126.PNG	101532	image/png	productPhotoFront	2017-05-17 01:58:06.578+00	2017-05-17 01:58:06.578+00	\N	\N	\N	\N	41	\N	\N	\N
161	rpstore/FFGARC170ExpansionPack/	\N	IMG_1126.PNG	101532	image/png	productPhotoBack	2017-05-17 01:58:06.832+00	2017-05-17 01:58:06.832+00	\N	\N	\N	\N	41	\N	\N	\N
162	rpstore/FFGSpecialForcesTieExpansioPack/	\N	IMG_1127.PNG	93852	image/png	productPhotoFront	2017-05-17 02:31:27.269+00	2017-05-17 02:31:27.269+00	\N	\N	\N	\N	42	\N	\N	\N
163	rpstore/FFGSpecialForcesTieExpansioPack/	\N	IMG_1127.PNG	93852	image/png	productPhotoBack	2017-05-17 02:31:27.441+00	2017-05-17 02:31:27.441+00	\N	\N	\N	\N	42	\N	\N	\N
164	rpstore/FFGProtectorateStarfighterExpansionPack/	\N	IMG_1128.PNG	100903	image/png	productPhotoFront	2017-05-17 02:34:42.491+00	2017-05-17 02:34:42.491+00	\N	\N	\N	\N	43	\N	\N	\N
165	rpstore/FFGProtectorateStarfighterExpansionPack/	\N	IMG_1128.PNG	100903	image/png	productPhotoBack	2017-05-17 02:34:42.678+00	2017-05-17 02:34:42.678+00	\N	\N	\N	\N	43	\N	\N	\N
166	rpstore/FFGShadowCasterExpansionPack/	\N	IMG_1129.PNG	152314	image/png	productPhotoFront	2017-05-17 02:37:17.341+00	2017-05-17 02:37:17.341+00	\N	\N	\N	\N	44	\N	\N	\N
167	rpstore/FFGShadowCasterExpansionPack/	\N	IMG_1129.PNG	152314	image/png	productPhotoBack	2017-05-17 02:37:17.508+00	2017-05-17 02:37:17.508+00	\N	\N	\N	\N	44	\N	\N	\N
168	rpstore/FFGQuadjumperExpansionPack/	\N	IMG_1130.PNG	94000	image/png	productPhotoFront	2017-05-17 02:40:50.15+00	2017-05-17 02:40:50.15+00	\N	\N	\N	\N	45	\N	\N	\N
169	rpstore/FFGQuadjumperExpansionPack/	\N	IMG_1130.PNG	94000	image/png	productPhotoBack	2017-05-17 02:40:50.326+00	2017-05-17 02:40:50.326+00	\N	\N	\N	\N	45	\N	\N	\N
170	rpstore/FFGSabinesTieFighterExpansionPack/	\N	IMG_1131.PNG	97903	image/png	productPhotoFront	2017-05-17 02:43:41.818+00	2017-05-17 02:43:41.818+00	\N	\N	\N	\N	46	\N	\N	\N
171	rpstore/FFGSabinesTieFighterExpansionPack/	\N	IMG_1131.PNG	97903	image/png	productPhotoBack	2017-05-17 02:43:41.989+00	2017-05-17 02:43:41.989+00	\N	\N	\N	\N	46	\N	\N	\N
172	rpstore/FFGUpsilonClassShuttleExpansionPack/	\N	IMG_1132.PNG	131486	image/png	productPhotoFront	2017-05-17 02:47:11.226+00	2017-05-17 02:47:11.226+00	\N	\N	\N	\N	47	\N	\N	\N
173	rpstore/FFGUpsilonClassShuttleExpansionPack/	\N	IMG_1132.PNG	131486	image/png	productPhotoBack	2017-05-17 02:47:11.419+00	2017-05-17 02:47:11.419+00	\N	\N	\N	\N	47	\N	\N	\N
174	rpstore/FFGUwingExpansionPack/	\N	IMG_1133.PNG	157154	image/png	productPhotoFront	2017-05-17 02:49:35.798+00	2017-05-17 02:49:35.798+00	\N	\N	\N	\N	48	\N	\N	\N
175	rpstore/FFGUwingExpansionPack/	\N	IMG_1133.PNG	157154	image/png	productPhotoBack	2017-05-17 02:49:35.976+00	2017-05-17 02:49:35.976+00	\N	\N	\N	\N	48	\N	\N	\N
176	rpstore/FFGTieStrikerExpansionPack/	\N	IMG_1134.PNG	96936	image/png	productPhotoFront	2017-05-17 02:51:56.281+00	2017-05-17 02:51:56.281+00	\N	\N	\N	\N	49	\N	\N	\N
177	rpstore/FFGTieStrikerExpansionPack/	\N	IMG_1134.PNG	96936	image/png	productPhotoBack	2017-05-17 02:51:56.466+00	2017-05-17 02:51:56.466+00	\N	\N	\N	\N	49	\N	\N	\N
178	rpstore/FFGRebelTransportExpansionPack/	\N	IMG_1135.PNG	132656	image/png	productPhotoFront	2017-05-17 02:55:37.898+00	2017-05-17 02:55:37.898+00	\N	\N	\N	\N	50	\N	\N	\N
179	rpstore/FFGRebelTransportExpansionPack/	\N	IMG_1135.PNG	132656	image/png	productPhotoBack	2017-05-17 02:55:38.068+00	2017-05-17 02:55:38.068+00	\N	\N	\N	\N	50	\N	\N	\N
180	rpstore/FFGTantiveIVExpansionPack/	\N	IMG_1136.PNG	128346	image/png	productPhotoFront	2017-05-17 02:58:36.216+00	2017-05-17 02:58:36.216+00	\N	\N	\N	\N	51	\N	\N	\N
181	rpstore/FFGTantiveIVExpansionPack/	\N	IMG_1136.PNG	128346	image/png	productPhotoBack	2017-05-17 02:58:36.386+00	2017-05-17 02:58:36.386+00	\N	\N	\N	\N	51	\N	\N	\N
182	rpstore/FFGImperialAssaultCarrier/	\N	IMG_1137.PNG	142215	image/png	productPhotoFront	2017-05-17 03:01:52.713+00	2017-05-17 03:01:52.713+00	\N	\N	\N	\N	52	\N	\N	\N
183	rpstore/FFGImperialAssaultCarrier/	\N	IMG_1137.PNG	142215	image/png	productPhotoBack	2017-05-17 03:01:52.881+00	2017-05-17 03:01:52.881+00	\N	\N	\N	\N	52	\N	\N	\N
184	rpstore/FFGImperialRaiderExpansionPack/	\N	IMG_1138.PNG	123388	image/png	productPhotoFront	2017-05-17 03:04:17.327+00	2017-05-17 03:04:17.327+00	\N	\N	\N	\N	53	\N	\N	\N
185	rpstore/FFGImperialRaiderExpansionPack/	\N	IMG_1138.PNG	123388	image/png	productPhotoBack	2017-05-17 03:04:17.509+00	2017-05-17 03:04:17.509+00	\N	\N	\N	\N	53	\N	\N	\N
186	rpstore/FFGSWArmada/	\N	IMG_1139.PNG	172786	image/png	productPhotoBack	2017-05-17 04:45:14.803+00	2017-05-17 04:45:14.803+00	\N	\N	\N	\N	54	\N	\N	\N
187	rpstore/FFGSWArmada/	\N	IMG_1139.PNG	172786	image/png	productPhotoFront	2017-05-17 04:45:14.966+00	2017-05-17 04:45:14.966+00	\N	\N	\N	\N	54	\N	\N	\N
188	rpstore/FFGVictoryClassStarDestroyerExpansionPack/	\N	IMG_1140.PNG	124108	image/png	productPhotoFront	2017-05-17 04:50:05.084+00	2017-05-17 04:50:05.084+00	\N	\N	\N	\N	55	\N	\N	\N
189	rpstore/FFGVictoryClassStarDestroyerExpansionPack/	\N	IMG_1140.PNG	124108	image/png	productPhotoBack	2017-05-17 04:50:05.265+00	2017-05-17 04:50:05.265+00	\N	\N	\N	\N	55	\N	\N	\N
190	rpstore/FFGCR90ExpansionPack/	\N	IMG_1141.PNG	120604	image/png	productPhotoFront	2017-05-17 04:55:18.975+00	2017-05-17 04:55:18.975+00	\N	\N	\N	\N	56	\N	\N	\N
191	rpstore/FFGCR90ExpansionPack/	\N	IMG_1141.PNG	120604	image/png	productPhotoBack	2017-05-17 04:55:19.13+00	2017-05-17 04:55:19.13+00	\N	\N	\N	\N	56	\N	\N	\N
192	rpstore/FFGNebulonBFrigateExpansionPack/	\N	IMG_1142.PNG	122761	image/png	productPhotoFront	2017-05-17 05:00:37.945+00	2017-05-17 05:00:37.945+00	\N	\N	\N	\N	57	\N	\N	\N
193	rpstore/FFGNebulonBFrigateExpansionPack/	\N	IMG_1142.PNG	122761	image/png	productPhotoBack	2017-05-17 05:00:38.131+00	2017-05-17 05:00:38.131+00	\N	\N	\N	\N	57	\N	\N	\N
194	rpstore/FFGAssaultFrigateMarkIIExpansionPack/	\N	IMG_1143.PNG	130726	image/png	productPhotoFront	2017-05-17 05:06:47.394+00	2017-05-17 05:06:47.394+00	\N	\N	\N	\N	58	\N	\N	\N
195	rpstore/FFGAssaultFrigateMarkIIExpansionPack/	\N	IMG_1143.PNG	130726	image/png	productPhotoBack	2017-05-17 05:06:47.568+00	2017-05-17 05:06:47.568+00	\N	\N	\N	\N	58	\N	\N	\N
196	rpstore/FFGGladiatorClassStarDestroyerExpansionPack/	\N	IMG_1144.PNG	125436	image/png	productPhotoFront	2017-05-17 05:11:07.467+00	2017-05-17 05:11:07.467+00	\N	\N	\N	\N	59	\N	\N	\N
197	rpstore/FFGGladiatorClassStarDestroyerExpansionPack/	\N	IMG_1144.PNG	125436	image/png	productPhotoBack	2017-05-17 05:11:07.643+00	2017-05-17 05:11:07.643+00	\N	\N	\N	\N	59	\N	\N	\N
198	rpstore/FFGRebelFighterSquadronsExpansionPack/	\N	IMG_1145.PNG	122792	image/png	productPhotoFront	2017-05-17 05:15:06.173+00	2017-05-17 05:15:06.173+00	\N	\N	\N	\N	60	\N	\N	\N
199	rpstore/FFGRebelFighterSquadronsExpansionPack/	\N	IMG_1145.PNG	122792	image/png	productPhotoBack	2017-05-17 05:15:06.347+00	2017-05-17 05:15:06.347+00	\N	\N	\N	\N	60	\N	\N	\N
200	rpstore/FFGImperialFighterSquadronExpansionPack/	\N	IMG_1146.PNG	125935	image/png	productPhotoBack	2017-05-17 05:19:35.564+00	2017-05-17 05:19:35.564+00	\N	\N	\N	\N	61	\N	\N	\N
201	rpstore/FFGImperialFighterSquadronExpansionPack/	\N	IMG_1146.PNG	125935	image/png	productPhotoFront	2017-05-17 05:19:35.729+00	2017-05-17 05:19:35.729+00	\N	\N	\N	\N	61	\N	\N	\N
202	rpstore/FFGInterdictorExpansionPack/	\N	IMG_1147.PNG	126404	image/png	productPhotoFront	2017-05-17 05:24:00.374+00	2017-05-17 05:24:00.374+00	\N	\N	\N	\N	62	\N	\N	\N
203	rpstore/FFGInterdictorExpansionPack/	\N	IMG_1147.PNG	126404	image/png	productPhotoBack	2017-05-17 05:24:00.56+00	2017-05-17 05:24:00.56+00	\N	\N	\N	\N	62	\N	\N	\N
204	rpstore/FFGLibertyExpansionPack/	\N	IMG_1148.PNG	134283	image/png	productPhotoFront	2017-05-17 05:27:48.509+00	2017-05-17 05:27:48.509+00	\N	\N	\N	\N	63	\N	\N	\N
205	rpstore/FFGLibertyExpansionPack/	\N	IMG_1148.PNG	134283	image/png	productPhotoBack	2017-05-17 05:27:48.692+00	2017-05-17 05:27:48.692+00	\N	\N	\N	\N	63	\N	\N	\N
206	rpstore/FFGImperialAssaultCarriersExpansionPack/	\N	IMG_1149.PNG	127008	image/png	productPhotoFront	2017-05-17 05:32:06.791+00	2017-05-17 05:32:06.791+00	\N	\N	\N	\N	64	\N	\N	\N
207	rpstore/FFGImperialAssaultCarriersExpansionPack/	\N	IMG_1149.PNG	127008	image/png	productPhotoBack	2017-05-17 05:32:07.014+00	2017-05-17 05:32:07.014+00	\N	\N	\N	\N	64	\N	\N	\N
208	rpstore/FFGRebelTransportsExpansionPack/	\N	IMG_1150.PNG	127362	image/png	productPhotoFront	2017-05-17 05:34:56.1+00	2017-05-17 05:34:56.1+00	\N	\N	\N	\N	65	\N	\N	\N
209	rpstore/FFGRebelTransportsExpansionPack/	\N	IMG_1150.PNG	127362	image/png	productPhotoBack	2017-05-17 05:34:56.266+00	2017-05-17 05:34:56.266+00	\N	\N	\N	\N	65	\N	\N	\N
210	rpstore/FFGPhoenixHomeExpansionPack/	\N	IMG_1151.PNG	140296	image/png	productPhotoFront	2017-05-17 05:39:48.099+00	2017-05-17 05:39:48.099+00	\N	\N	\N	\N	66	\N	\N	\N
211	rpstore/FFGPhoenixHomeExpansionPack/	\N	IMG_1151.PNG	140296	image/png	productPhotoBack	2017-05-17 05:39:48.285+00	2017-05-17 05:39:48.285+00	\N	\N	\N	\N	66	\N	\N	\N
212	rpstore/FFGImperialLightCruiserExpansionPack/	\N	IMG_1152.PNG	125657	image/png	productPhotoBack	2017-05-17 05:44:01.129+00	2017-05-17 05:44:01.129+00	\N	\N	\N	\N	67	\N	\N	\N
213	rpstore/FFGImperialLightCruiserExpansionPack/	\N	IMG_1152.PNG	125657	image/png	productPhotoFront	2017-05-17 05:44:01.29+00	2017-05-17 05:44:01.29+00	\N	\N	\N	\N	67	\N	\N	\N
214	rpstore/FFGRebelFighterSquadronsIIExpansionPack/	\N	IMG_1153.PNG	135002	image/png	productPhotoFront	2017-05-17 05:47:44.52+00	2017-05-17 05:47:44.52+00	\N	\N	\N	\N	68	\N	\N	\N
215	rpstore/FFGRebelFighterSquadronsIIExpansionPack/	\N	IMG_1153.PNG	135002	image/png	productPhotoBack	2017-05-17 05:47:44.828+00	2017-05-17 05:47:44.828+00	\N	\N	\N	\N	68	\N	\N	\N
216	rpstore/FFGImperialFighterSquadronsIIExpansionPack/	\N	IMG_1154.PNG	137960	image/png	productPhotoFront	2017-05-17 05:51:25.45+00	2017-05-17 05:51:25.45+00	\N	\N	\N	\N	69	\N	\N	\N
217	rpstore/FFGImperialFighterSquadronsIIExpansionPack/	\N	IMG_1154.PNG	137960	image/png	productPhotoBack	2017-05-17 05:51:25.626+00	2017-05-17 05:51:25.626+00	\N	\N	\N	\N	69	\N	\N	\N
218	rpstore/FFGImperialclassStarDestroyerExpansionPack/	\N	IMG_1155.PNG	118907	image/png	productPhotoBack	2017-05-17 05:55:55.446+00	2017-05-17 05:55:55.446+00	\N	\N	\N	\N	70	\N	\N	\N
219	rpstore/FFGImperialclassStarDestroyerExpansionPack/	\N	IMG_1155.PNG	118907	image/png	productPhotoFront	2017-05-17 05:55:55.608+00	2017-05-17 05:55:55.608+00	\N	\N	\N	\N	70	\N	\N	\N
220	rpstore/FFGMC30cFrigateExpansionPack/	\N	IMG_1156.PNG	124920	image/png	productPhotoFront	2017-05-17 05:59:24.284+00	2017-05-17 05:59:24.284+00	\N	\N	\N	\N	71	\N	\N	\N
221	rpstore/FFGMC30cFrigateExpansionPack/	\N	IMG_1156.PNG	124920	image/png	productPhotoBack	2017-05-17 05:59:24.46+00	2017-05-17 05:59:24.46+00	\N	\N	\N	\N	71	\N	\N	\N
222	rpstore/FFGHomeOneExpansionPack/	\N	IMG_1157.PNG	129427	image/png	productPhotoFront	2017-05-17 06:01:42.461+00	2017-05-17 06:01:42.461+00	\N	\N	\N	\N	72	\N	\N	\N
223	rpstore/FFGHomeOneExpansionPack/	\N	IMG_1157.PNG	129427	image/png	productPhotoBack	2017-05-17 06:01:42.635+00	2017-05-17 06:01:42.635+00	\N	\N	\N	\N	72	\N	\N	\N
224	rpstore/FFGRoguesandVillainsExpansionPack/	\N	IMG_1158.PNG	130675	image/png	productPhotoFront	2017-05-17 06:04:29.694+00	2017-05-17 06:04:29.694+00	\N	\N	\N	\N	73	\N	\N	\N
225	rpstore/FFGRoguesandVillainsExpansionPack/	\N	IMG_1158.PNG	130675	image/png	productPhotoBack	2017-05-17 06:04:29.872+00	2017-05-17 06:04:29.872+00	\N	\N	\N	\N	73	\N	\N	\N
226	rpstore/FFGImperialRaiderExpansionPack/	\N	IMG_1159.PNG	116465	image/png	productPhotoFront	2017-05-17 06:06:52.414+00	2017-05-17 06:06:52.414+00	\N	\N	\N	\N	74	\N	\N	\N
227	rpstore/FFGImperialRaiderExpansionPack/	\N	IMG_1159.PNG	116465	image/png	productPhotoBack	2017-05-17 06:06:52.581+00	2017-05-17 06:06:52.581+00	\N	\N	\N	\N	74	\N	\N	\N
228	rpstore/GWStartCollectingSpaceMarines/	\N	IMG_1163.JPG	39081	image/jpeg	productPhotoFront	2017-05-17 16:35:24.2+00	2017-05-17 16:35:24.2+00	\N	\N	\N	\N	75	\N	\N	\N
229	rpstore/GWStartCollectingSpaceMarines/	\N	IMG_1163.JPG	39081	image/jpeg	productPhotoBack	2017-05-17 16:35:24.367+00	2017-05-17 16:35:24.367+00	\N	\N	\N	\N	75	\N	\N	\N
230	rpstore/GWTriumvirateofthePrimarch/	\N	IMG_1160.JPG	27766	image/jpeg	productPhotoFront	2017-05-17 16:38:39.475+00	2017-05-17 16:38:39.475+00	\N	\N	\N	\N	76	\N	\N	\N
231	rpstore/GWTriumvirateofthePrimarch/	\N	IMG_1160.JPG	27766	image/jpeg	productPhotoBack	2017-05-17 16:38:39.647+00	2017-05-17 16:38:39.647+00	\N	\N	\N	\N	76	\N	\N	\N
232	rpstore/GWStormhawkInterceptor/	\N	IMG_1161.JPG	14965	image/jpeg	productPhotoFront	2017-05-17 16:41:54.899+00	2017-05-17 16:41:54.899+00	\N	\N	\N	\N	77	\N	\N	\N
233	rpstore/GWStormhawkInterceptor/	\N	IMG_1161.JPG	14965	image/jpeg	productPhotoBack	2017-05-17 16:41:55.066+00	2017-05-17 16:41:55.066+00	\N	\N	\N	\N	77	\N	\N	\N
234	rpstore/GWStormtalonGunship/	\N	IMG_1162.JPG	20145	image/jpeg	productPhotoFront	2017-05-17 16:44:53.535+00	2017-05-17 16:44:53.535+00	\N	\N	\N	\N	78	\N	\N	\N
235	rpstore/GWStormtalonGunship/	\N	IMG_1162.JPG	20145	image/jpeg	productPhotoBack	2017-05-17 16:44:53.709+00	2017-05-17 16:44:53.709+00	\N	\N	\N	\N	78	\N	\N	\N
236	rpstore/GWSpaceMarineTacticalSquad/	\N	IMG_1164.JPG	24416	image/jpeg	productPhotoBack	2017-05-17 16:49:24.568+00	2017-05-17 16:49:24.568+00	\N	\N	\N	\N	79	\N	\N	\N
237	rpstore/GWSpaceMarineTacticalSquad/	\N	IMG_1164.JPG	24416	image/jpeg	productPhotoFront	2017-05-17 16:49:24.722+00	2017-05-17 16:49:24.722+00	\N	\N	\N	\N	79	\N	\N	\N
238	rpstore/GWSpaceMarineAssaultSquad/	\N	IMG_1165.JPG	21074	image/jpeg	productPhotoFront	2017-05-17 16:52:19.989+00	2017-05-17 16:52:19.989+00	\N	\N	\N	\N	80	\N	\N	\N
239	rpstore/GWSpaceMarineAssaultSquad/	\N	IMG_1165.JPG	21074	image/jpeg	productPhotoBack	2017-05-17 16:52:20.169+00	2017-05-17 16:52:20.169+00	\N	\N	\N	\N	80	\N	\N	\N
240	rpstore/GWTerminatorSquad/	\N	IMG_1166.JPG	25310	image/jpeg	productPhotoFront	2017-05-17 16:55:50.155+00	2017-05-17 16:55:50.155+00	\N	\N	\N	\N	81	\N	\N	\N
241	rpstore/GWTerminatorSquad/	\N	IMG_1166.JPG	25310	image/jpeg	productPhotoBack	2017-05-17 16:55:50.341+00	2017-05-17 16:55:50.341+00	\N	\N	\N	\N	81	\N	\N	\N
242	rpstore/GWStormravenGunship/	\N	IMG_1167.JPG	17467	image/jpeg	productPhotoFront	2017-05-17 16:59:08.079+00	2017-05-17 16:59:08.079+00	\N	\N	\N	\N	82	\N	\N	\N
243	rpstore/GWStormravenGunship/	\N	IMG_1167.JPG	17467	image/jpeg	productPhotoBack	2017-05-17 16:59:08.266+00	2017-05-17 16:59:08.266+00	\N	\N	\N	\N	82	\N	\N	\N
244	rpstore/GWDevastatorSquad/	\N	IMG_1168.JPG	26810	image/jpeg	productPhotoFront	2017-05-17 17:05:14.861+00	2017-05-17 17:05:14.861+00	\N	\N	\N	\N	83	\N	\N	\N
245	rpstore/GWDevastatorSquad/	\N	IMG_1168.JPG	26810	image/jpeg	productPhotoBack	2017-05-17 17:05:15.017+00	2017-05-17 17:05:15.017+00	\N	\N	\N	\N	83	\N	\N	\N
246	rpstore/GWSternguardVeteranSquad/	\N	IMG_1169.JPG	25866	image/jpeg	productPhotoFront	2017-05-17 17:08:33.648+00	2017-05-17 17:08:33.648+00	\N	\N	\N	\N	84	\N	\N	\N
247	rpstore/GWSternguardVeteranSquad/	\N	IMG_1169.JPG	25866	image/jpeg	productPhotoBack	2017-05-17 17:08:33.828+00	2017-05-17 17:08:33.828+00	\N	\N	\N	\N	84	\N	\N	\N
248	rpstore/GWVanguardVeteranSquad/	\N	IMG_1170.JPG	26932	image/jpeg	productPhotoFront	2017-05-17 17:10:48.89+00	2017-05-17 17:10:48.89+00	\N	\N	\N	\N	85	\N	\N	\N
249	rpstore/GWVanguardVeteranSquad/	\N	IMG_1170.JPG	26932	image/jpeg	productPhotoBack	2017-05-17 17:10:49.058+00	2017-05-17 17:10:49.058+00	\N	\N	\N	\N	85	\N	\N	\N
250	rpstore/GWDropPod/	\N	IMG_1171.JPG	14586	image/jpeg	productPhotoFront	2017-05-17 17:14:47.328+00	2017-05-17 17:14:47.328+00	\N	\N	\N	\N	86	\N	\N	\N
251	rpstore/GWDropPod/	\N	IMG_1171.JPG	14586	image/jpeg	productPhotoBack	2017-05-17 17:14:47.499+00	2017-05-17 17:14:47.499+00	\N	\N	\N	\N	86	\N	\N	\N
252	rpstore/GWLandRaider/	\N	IMG_1172.JPG	15760	image/jpeg	productPhotoFront	2017-05-17 17:17:10.174+00	2017-05-17 17:17:10.174+00	\N	\N	\N	\N	12	\N	\N	\N
253	rpstore/GWLandRaider/	\N	IMG_1172.JPG	15760	image/jpeg	productPhotoBack	2017-05-17 17:17:10.39+00	2017-05-17 17:17:10.39+00	\N	\N	\N	\N	12	\N	\N	\N
254	rpstore/GWSpaceMarineRhino/	\N	IMG_1173.JPG	17104	image/jpeg	productPhotoBack	2017-05-17 19:04:53.143+00	2017-05-17 19:04:53.143+00	\N	\N	\N	\N	87	\N	\N	\N
255	rpstore/GWSpaceMarineRhino/	\N	IMG_1173.JPG	17104	image/jpeg	productPhotoFront	2017-05-17 19:04:53.3+00	2017-05-17 19:04:53.3+00	\N	\N	\N	\N	87	\N	\N	\N
256	rpstore/GWCenturionDevastatorSquad/	\N	IMG_1174.JPG	25326	image/jpeg	productPhotoFront	2017-05-17 19:08:02.291+00	2017-05-17 19:08:02.291+00	\N	\N	\N	\N	88	\N	\N	\N
257	rpstore/GWCenturionDevastatorSquad/	\N	IMG_1174.JPG	25326	image/jpeg	productPhotoBack	2017-05-17 19:08:02.587+00	2017-05-17 19:08:02.587+00	\N	\N	\N	\N	88	\N	\N	\N
258	rpstore/GWCenturionAssaultSquad/	\N	IMG_1175.JPG	25617	image/jpeg	productPhotoFront	2017-05-17 19:09:53.744+00	2017-05-17 19:09:53.744+00	\N	\N	\N	\N	89	\N	\N	\N
259	rpstore/GWCenturionAssaultSquad/	\N	IMG_1175.JPG	25617	image/jpeg	productPhotoBack	2017-05-17 19:09:53.941+00	2017-05-17 19:09:53.941+00	\N	\N	\N	\N	89	\N	\N	\N
260	rpstore/GWLandRaiderRedeemer/	\N	IMG_1176.JPG	14388	image/jpeg	productPhotoFront	2017-05-17 19:13:16.065+00	2017-05-17 19:13:16.065+00	\N	\N	\N	\N	90	\N	\N	\N
261	rpstore/GWLandRaiderRedeemer/	\N	IMG_1176.JPG	14388	image/jpeg	productPhotoBack	2017-05-17 19:13:16.236+00	2017-05-17 19:13:16.236+00	\N	\N	\N	\N	90	\N	\N	\N
262	rpstore/GWLandRaiderCrusader/	\N	IMG_1177.JPG	16008	image/jpeg	productPhotoBack	2017-05-17 19:16:01.02+00	2017-05-17 19:16:01.02+00	\N	\N	\N	\N	91	\N	\N	\N
263	rpstore/GWLandRaiderCrusader/	\N	IMG_1177.JPG	16008	image/jpeg	productPhotoFront	2017-05-17 19:16:01.184+00	2017-05-17 19:16:01.184+00	\N	\N	\N	\N	91	\N	\N	\N
264	rpstore/GWSpaceMarineHunter/	\N	IMG_1178.JPG	19095	image/jpeg	productPhotoFront	2017-05-17 19:18:15.434+00	2017-05-17 19:18:15.434+00	\N	\N	\N	\N	92	\N	\N	\N
265	rpstore/GWSpaceMarineHunter/	\N	IMG_1178.JPG	19095	image/jpeg	productPhotoBack	2017-05-17 19:18:15.626+00	2017-05-17 19:18:15.626+00	\N	\N	\N	\N	92	\N	\N	\N
266	rpstore/GWSpaceMarineStalker/	\N	IMG_1179.JPG	19272	image/jpeg	productPhotoFront	2017-05-17 19:20:20.025+00	2017-05-17 19:20:20.025+00	\N	\N	\N	\N	93	\N	\N	\N
267	rpstore/GWSpaceMarineStalker/	\N	IMG_1179.JPG	19272	image/jpeg	productPhotoBack	2017-05-17 19:20:20.204+00	2017-05-17 19:20:20.204+00	\N	\N	\N	\N	93	\N	\N	\N
268	rpstore/GWTartarosTerminators/	\N	IMG_1180.JPG	22672	image/jpeg	productPhotoFront	2017-05-17 19:23:23.268+00	2017-05-17 19:23:23.268+00	\N	\N	\N	\N	94	\N	\N	\N
269	rpstore/GWTartarosTerminators/	\N	IMG_1180.JPG	22672	image/jpeg	productPhotoBack	2017-05-17 19:23:23.437+00	2017-05-17 19:23:23.437+00	\N	\N	\N	\N	94	\N	\N	\N
270	rpstore/GWSpaceMarineTerminatorCommand/	\N	IMG_1181.JPG	29690	image/jpeg	productPhotoBack	2017-05-17 19:27:28.399+00	2017-05-17 19:27:28.399+00	\N	\N	\N	\N	95	\N	\N	\N
271	rpstore/GWSpaceMarineTerminatorCommand/	\N	IMG_1181.JPG	29690	image/jpeg	productPhotoFront	2017-05-17 19:27:28.569+00	2017-05-17 19:27:28.569+00	\N	\N	\N	\N	95	\N	\N	\N
272	rpstore/GWSpaceMarineVindicator/	\N	IMG_1183.JPG	16396	image/jpeg	productPhotoFront	2017-05-17 19:30:22.556+00	2017-05-17 19:30:22.556+00	\N	\N	\N	\N	96	\N	\N	\N
273	rpstore/GWSpaceMarineVindicator/	\N	IMG_1183.JPG	16396	image/jpeg	productPhotoBack	2017-05-17 19:30:22.752+00	2017-05-17 19:30:22.752+00	\N	\N	\N	\N	96	\N	\N	\N
274	rpstore/GWPredator/	\N	IMG_1184.JPG	18058	image/jpeg	productPhotoFront	2017-05-17 19:32:14.435+00	2017-05-17 19:32:14.435+00	\N	\N	\N	\N	97	\N	\N	\N
275	rpstore/GWPredator/	\N	IMG_1184.JPG	18058	image/jpeg	productPhotoBack	2017-05-17 19:32:14.614+00	2017-05-17 19:32:14.614+00	\N	\N	\N	\N	97	\N	\N	\N
276	rpstore/GWSpaceMarinesSkyhammerTacticalSquad/	\N	IMG_1185.JPG	23095	image/jpeg	productPhotoFront	2017-05-17 19:46:10.336+00	2017-05-17 19:46:10.336+00	\N	\N	\N	\N	98	\N	\N	\N
277	rpstore/GWSpaceMarinesSkyhammerTacticalSquad/	\N	IMG_1185.JPG	23095	image/jpeg	productPhotoBack	2017-05-17 19:46:10.506+00	2017-05-17 19:46:10.506+00	\N	\N	\N	\N	98	\N	\N	\N
278	rpstore/GWSpaceMarineHeroes/	\N	IMG_1186.JPG	30151	image/jpeg	productPhotoFront	2017-05-17 19:48:59.279+00	2017-05-17 19:48:59.279+00	\N	\N	\N	\N	99	\N	\N	\N
279	rpstore/GWSpaceMarineHeroes/	\N	IMG_1186.JPG	30151	image/jpeg	productPhotoBack	2017-05-17 19:48:59.453+00	2017-05-17 19:48:59.453+00	\N	\N	\N	\N	99	\N	\N	\N
280	rpstore/GWMarkIIISpaceMarines/	\N	IMG_1187.JPG	29551	image/jpeg	productPhotoFront	2017-05-17 19:51:47.695+00	2017-05-17 19:51:47.695+00	\N	\N	\N	\N	100	\N	\N	\N
281	rpstore/GWMarkIIISpaceMarines/	\N	IMG_1187.JPG	29551	image/jpeg	productPhotoBack	2017-05-17 19:51:47.908+00	2017-05-17 19:51:47.908+00	\N	\N	\N	\N	100	\N	\N	\N
282	rpstore/GWSpaceMarineTerminatorCloseCombatSquad/	\N	IMG_1188.JPG	27241	image/jpeg	productPhotoBack	2017-05-17 19:56:27.35+00	2017-05-17 19:56:27.35+00	\N	\N	\N	\N	101	\N	\N	\N
283	rpstore/GWSpaceMarineTerminatorCloseCombatSquad/	\N	IMG_1188.JPG	27241	image/jpeg	productPhotoFront	2017-05-17 19:56:27.508+00	2017-05-17 19:56:27.508+00	\N	\N	\N	\N	101	\N	\N	\N
284	rpstore/GWSpaceMarineCompanyCommand/	\N	IMG_1189.JPG	27512	image/jpeg	productPhotoFront	2017-05-17 19:59:51.937+00	2017-05-17 19:59:51.937+00	\N	\N	\N	\N	102	\N	\N	\N
285	rpstore/GWSpaceMarineCompanyCommand/	\N	IMG_1189.JPG	27512	image/jpeg	productPhotoBack	2017-05-17 19:59:52.115+00	2017-05-17 19:59:52.115+00	\N	\N	\N	\N	102	\N	\N	\N
286	rpstore/GWSpaceMarineDreadnought/	\N	IMG_1190.JPG	21099	image/jpeg	productPhotoFront	2017-05-17 20:02:46.295+00	2017-05-17 20:02:46.295+00	\N	\N	\N	\N	103	\N	\N	\N
287	rpstore/GWSpaceMarineDreadnought/	\N	IMG_1190.JPG	21099	image/jpeg	productPhotoBack	2017-05-17 20:02:46.464+00	2017-05-17 20:02:46.464+00	\N	\N	\N	\N	103	\N	\N	\N
288	rpstore/GWIroncladDreadnought/	\N	IMG_1191.JPG	19860	image/jpeg	productPhotoFront	2017-05-17 20:05:41.544+00	2017-05-17 20:05:41.544+00	\N	\N	\N	\N	104	\N	\N	\N
289	rpstore/GWIroncladDreadnought/	\N	IMG_1191.JPG	19860	image/jpeg	productPhotoBack	2017-05-17 20:05:41.727+00	2017-05-17 20:05:41.727+00	\N	\N	\N	\N	104	\N	\N	\N
290	rpstore/GWSpaceMarineVenerableDreadnought/	\N	IMG_1192.JPG	22537	image/jpeg	productPhotoFront	2017-05-17 20:10:02.068+00	2017-05-17 20:10:02.068+00	\N	\N	\N	\N	105	\N	\N	\N
291	rpstore/GWSpaceMarineVenerableDreadnought/	\N	IMG_1192.JPG	22537	image/jpeg	productPhotoBack	2017-05-17 20:10:02.223+00	2017-05-17 20:10:02.223+00	\N	\N	\N	\N	105	\N	\N	\N
292	rpstore/GWRazorback/	\N	IMG_1193.JPG	14205	image/jpeg	productPhotoFront	2017-05-17 20:13:22.17+00	2017-05-17 20:13:22.17+00	\N	\N	\N	\N	106	\N	\N	\N
293	rpstore/GWRazorback/	\N	IMG_1193.JPG	14205	image/jpeg	productPhotoBack	2017-05-17 20:13:22.348+00	2017-05-17 20:13:22.348+00	\N	\N	\N	\N	106	\N	\N	\N
294	rpstore/GWScoutBikeSquad/	\N	IMG_1194.JPG	19769	image/jpeg	productPhotoFront	2017-05-17 20:17:09.42+00	2017-05-17 20:17:09.42+00	\N	\N	\N	\N	107	\N	\N	\N
295	rpstore/GWScoutBikeSquad/	\N	IMG_1194.JPG	19769	image/jpeg	productPhotoBack	2017-05-17 20:17:09.59+00	2017-05-17 20:17:09.59+00	\N	\N	\N	\N	107	\N	\N	\N
296	rpstore/GWSpaceMarineBikeSquad/	\N	IMG_1195.JPG	22567	image/jpeg	productPhotoFront	2017-05-17 20:19:44.94+00	2017-05-17 20:19:44.94+00	\N	\N	\N	\N	108	\N	\N	\N
297	rpstore/GWSpaceMarineBikeSquad/	\N	IMG_1195.JPG	22567	image/jpeg	productPhotoBack	2017-05-17 20:19:45.121+00	2017-05-17 20:19:45.121+00	\N	\N	\N	\N	108	\N	\N	\N
298	rpstore/GWSpaceMarineCommandSquad/	\N	IMG_1196.JPG	27769	image/jpeg	productPhotoBack	2017-05-17 20:23:29.514+00	2017-05-17 20:23:29.514+00	\N	\N	\N	\N	109	\N	\N	\N
299	rpstore/GWSpaceMarineCommandSquad/	\N	IMG_1196.JPG	27769	image/jpeg	productPhotoFront	2017-05-17 20:23:29.669+00	2017-05-17 20:23:29.669+00	\N	\N	\N	\N	109	\N	\N	\N
300	rpstore/GWSpaceMarineLibrarianinTerminatorArmour/	\N	IMG_1197.JPG	23537	image/jpeg	productPhotoFront	2017-05-17 20:28:30.733+00	2017-05-17 20:28:30.733+00	\N	\N	\N	\N	110	\N	\N	\N
301	rpstore/GWSpaceMarineLibrarianinTerminatorArmour/	\N	IMG_1197.JPG	23537	image/jpeg	productPhotoBack	2017-05-17 20:28:30.9+00	2017-05-17 20:28:30.9+00	\N	\N	\N	\N	110	\N	\N	\N
302	rpstore/GWSpaceMarineLibrarian/	\N	IMG_1198.JPG	19242	image/jpeg	productPhotoFront	2017-05-17 20:30:49.056+00	2017-05-17 20:30:49.056+00	\N	\N	\N	\N	111	\N	\N	\N
303	rpstore/GWSpaceMarineLibrarian/	\N	IMG_1198.JPG	19242	image/jpeg	productPhotoBack	2017-05-17 20:30:49.229+00	2017-05-17 20:30:49.229+00	\N	\N	\N	\N	111	\N	\N	\N
304	rpstore/GWLandSpeederStorm/	\N	IMG_1199.JPG	19070	image/jpeg	productPhotoFront	2017-05-17 20:34:07.062+00	2017-05-17 20:34:07.062+00	\N	\N	\N	\N	112	\N	\N	\N
305	rpstore/GWLandSpeederStorm/	\N	IMG_1199.JPG	19070	image/jpeg	productPhotoBack	2017-05-17 20:34:07.227+00	2017-05-17 20:34:07.227+00	\N	\N	\N	\N	112	\N	\N	\N
306	rpstore/GWLandSpeeder/	\N	IMG_1201.JPG	18485	image/jpeg	productPhotoFront	2017-05-17 20:36:15.082+00	2017-05-17 20:36:15.082+00	\N	\N	\N	\N	113	\N	\N	\N
307	rpstore/GWLandSpeeder/	\N	IMG_1201.JPG	18485	image/jpeg	productPhotoBack	2017-05-17 20:36:15.255+00	2017-05-17 20:36:15.255+00	\N	\N	\N	\N	113	\N	\N	\N
308	rpstore/GWSpaceMarineCaptain/	\N	IMG_1200.JPG	16983	image/jpeg	productPhotoFront	2017-05-17 20:39:37.672+00	2017-05-17 20:39:37.672+00	\N	\N	\N	\N	114	\N	\N	\N
309	rpstore/GWSpaceMarineCaptain/	\N	IMG_1200.JPG	16983	image/jpeg	productPhotoBack	2017-05-17 20:39:37.844+00	2017-05-17 20:39:37.844+00	\N	\N	\N	\N	114	\N	\N	\N
310	rpstore/GWSpaceMarineAttackBike/	\N	IMG_1202.JPG	17396	image/jpeg	productPhotoFront	2017-05-17 21:09:46.814+00	2017-05-17 21:09:46.814+00	\N	\N	\N	\N	115	\N	\N	\N
311	rpstore/GWSpaceMarineAttackBike/	\N	IMG_1202.JPG	17396	image/jpeg	productPhotoBack	2017-05-17 21:09:46.999+00	2017-05-17 21:09:46.999+00	\N	\N	\N	\N	115	\N	\N	\N
312	rpstore/GWSpaceMarineScouts/	\N	IMG_1203.JPG	25793	image/jpeg	productPhotoFront	2017-05-17 21:13:07.069+00	2017-05-17 21:13:07.069+00	\N	\N	\N	\N	116	\N	\N	\N
313	rpstore/GWSpaceMarineScouts/	\N	IMG_1203.JPG	25793	image/jpeg	productPhotoBack	2017-05-17 21:13:07.239+00	2017-05-17 21:13:07.239+00	\N	\N	\N	\N	116	\N	\N	\N
314	rpstore/GWSpaceMarineScoutswithSniperRifles/	\N	IMG_1204.JPG	26374	image/jpeg	productPhotoFront	2017-05-17 21:16:47.909+00	2017-05-17 21:16:47.909+00	\N	\N	\N	\N	117	\N	\N	\N
315	rpstore/GWSpaceMarineScoutswithSniperRifles/	\N	IMG_1204.JPG	26374	image/jpeg	productPhotoBack	2017-05-17 21:16:48.084+00	2017-05-17 21:16:48.084+00	\N	\N	\N	\N	117	\N	\N	\N
316	rpstore/GWSpaceMarineCommander/	\N	IMG_1205.JPG	18607	image/jpeg	productPhotoFront	2017-05-17 21:18:59.041+00	2017-05-17 21:18:59.041+00	\N	\N	\N	\N	118	\N	\N	\N
317	rpstore/GWSpaceMarineCommander/	\N	IMG_1205.JPG	18607	image/jpeg	productPhotoBack	2017-05-17 21:18:59.221+00	2017-05-17 21:18:59.221+00	\N	\N	\N	\N	118	\N	\N	\N
318	rpstore/GWStartCollectingBloodAngels/	\N	IMG_1206.JPG	38301	image/jpeg	productPhotoFront	2017-05-17 21:26:32.195+00	2017-05-17 21:26:32.195+00	\N	\N	\N	\N	119	\N	\N	\N
319	rpstore/GWStartCollectingBloodAngels/	\N	IMG_1206.JPG	38301	image/jpeg	productPhotoBack	2017-05-17 21:26:32.359+00	2017-05-17 21:26:32.359+00	\N	\N	\N	\N	119	\N	\N	\N
320	rpstore/GWBloodAngelsTacticalSquad/	\N	IMG_1207.JPG	30849	image/jpeg	productPhotoFront	2017-05-17 21:29:43.182+00	2017-05-17 21:29:43.182+00	\N	\N	\N	\N	120	\N	\N	\N
321	rpstore/GWBloodAngelsTacticalSquad/	\N	IMG_1207.JPG	30849	image/jpeg	productPhotoBack	2017-05-17 21:29:43.349+00	2017-05-17 21:29:43.349+00	\N	\N	\N	\N	120	\N	\N	\N
322	rpstore/GWBloodAngelsTerminatorAssaultSquad/	\N	IMG_1208.JPG	23665	image/jpeg	productPhotoFront	2017-05-17 21:33:58.3+00	2017-05-17 21:33:58.3+00	\N	\N	\N	\N	121	\N	\N	\N
323	rpstore/GWBloodAngelsTerminatorAssaultSquad/	\N	IMG_1208.JPG	23665	image/jpeg	productPhotoBack	2017-05-17 21:33:58.467+00	2017-05-17 21:33:58.467+00	\N	\N	\N	\N	121	\N	\N	\N
324	rpstore/GWBaalPredator/	\N	IMG_1209.JPG	17374	image/jpeg	productPhotoBack	2017-05-17 23:53:25.965+00	2017-05-17 23:53:25.965+00	\N	\N	\N	\N	122	\N	\N	\N
325	rpstore/GWBaalPredator/	\N	IMG_1209.JPG	17374	image/jpeg	productPhotoFront	2017-05-17 23:53:26.125+00	2017-05-17 23:53:26.125+00	\N	\N	\N	\N	122	\N	\N	\N
326	rpstore/GWBloodAngelsFuriosoDreadnaught/	\N	IMG_1210.JPG	29651	image/jpeg	productPhotoFront	2017-05-17 23:57:03.21+00	2017-05-17 23:57:03.21+00	\N	\N	\N	\N	123	\N	\N	\N
327	rpstore/GWBloodAngelsFuriosoDreadnaught/	\N	IMG_1210.JPG	29651	image/jpeg	productPhotoBack	2017-05-17 23:57:03.384+00	2017-05-17 23:57:03.384+00	\N	\N	\N	\N	123	\N	\N	\N
328	rpstore/GWSanguinaryPriest/	\N	IMG_1211.JPG	17376	image/jpeg	productPhotoFront	2017-05-18 00:01:30.412+00	2017-05-18 00:01:30.412+00	\N	\N	\N	\N	124	\N	\N	\N
329	rpstore/GWSanguinaryPriest/	\N	IMG_1211.JPG	17376	image/jpeg	productPhotoBack	2017-05-18 00:01:30.584+00	2017-05-18 00:01:30.584+00	\N	\N	\N	\N	124	\N	\N	\N
330	rpstore/GWBloodAngelsSternguardVeteranSquad/	\N	IMG_1212.JPG	20960	image/jpeg	productPhotoBack	2017-05-18 00:04:40.595+00	2017-05-18 00:04:40.595+00	\N	\N	\N	\N	125	\N	\N	\N
331	rpstore/GWBloodAngelsSternguardVeteranSquad/	\N	IMG_1212.JPG	20960	image/jpeg	productPhotoFront	2017-05-18 00:04:40.745+00	2017-05-18 00:04:40.745+00	\N	\N	\N	\N	125	\N	\N	\N
332	rpstore/GWBloodAngelsLibrarianDreadnought/	\N	IMG_1213.JPG	26792	image/jpeg	productPhotoFront	2017-05-18 00:08:59.434+00	2017-05-18 00:08:59.434+00	\N	\N	\N	\N	126	\N	\N	\N
333	rpstore/GWBloodAngelsLibrarianDreadnought/	\N	IMG_1213.JPG	26792	image/jpeg	productPhotoBack	2017-05-18 00:08:59.607+00	2017-05-18 00:08:59.607+00	\N	\N	\N	\N	126	\N	\N	\N
334	rpstore/GWBloodAngelsDeathCompanyDreadnought/	\N	IMG_1214.JPG	29266	image/jpeg	productPhotoFront	2017-05-18 00:12:39.666+00	2017-05-18 00:12:39.666+00	\N	\N	\N	\N	127	\N	\N	\N
335	rpstore/GWBloodAngelsDeathCompanyDreadnought/	\N	IMG_1214.JPG	29266	image/jpeg	productPhotoBack	2017-05-18 00:12:39.844+00	2017-05-18 00:12:39.844+00	\N	\N	\N	\N	127	\N	\N	\N
336	rpstore/GWBloodAngelsVanguardVeteranSquad/	\N	IMG_1215.JPG	22762	image/jpeg	productPhotoBack	2017-05-18 00:16:40.556+00	2017-05-18 00:16:40.556+00	\N	\N	\N	\N	128	\N	\N	\N
337	rpstore/GWBloodAngelsVanguardVeteranSquad/	\N	IMG_1215.JPG	22762	image/jpeg	productPhotoFront	2017-05-18 00:16:40.722+00	2017-05-18 00:16:40.722+00	\N	\N	\N	\N	128	\N	\N	\N
338	rpstore/GWBloodAngelsCommandSquad/	\N	IMG_1216.JPG	22888	image/jpeg	productPhotoFront	2017-05-18 00:20:27.961+00	2017-05-18 00:20:27.961+00	\N	\N	\N	\N	129	\N	\N	\N
339	rpstore/GWBloodAngelsCommandSquad/	\N	IMG_1216.JPG	22888	image/jpeg	productPhotoBack	2017-05-18 00:20:28.143+00	2017-05-18 00:20:28.143+00	\N	\N	\N	\N	129	\N	\N	\N
340	rpstore/GWBloodAngelsAssaultSquad/	\N	IMG_1217.JPG	22569	image/jpeg	productPhotoFront	2017-05-18 00:23:15.726+00	2017-05-18 00:23:15.726+00	\N	\N	\N	\N	130	\N	\N	\N
341	rpstore/GWBloodAngelsAssaultSquad/	\N	IMG_1217.JPG	22569	image/jpeg	productPhotoBack	2017-05-18 00:23:15.914+00	2017-05-18 00:23:15.914+00	\N	\N	\N	\N	130	\N	\N	\N
342	rpstore/GWSanguinaryGuard/	\N	IMG_1218.JPG	20411	image/jpeg	productPhotoFront	2017-05-18 00:25:51.013+00	2017-05-18 00:25:51.013+00	\N	\N	\N	\N	131	\N	\N	\N
343	rpstore/GWSanguinaryGuard/	\N	IMG_1218.JPG	20411	image/jpeg	productPhotoBack	2017-05-18 00:25:51.19+00	2017-05-18 00:25:51.19+00	\N	\N	\N	\N	131	\N	\N	\N
344	rpstore/GWBloodAngelsChaplainwithJumpPack/	\N	IMG_1219.JPG	15861	image/jpeg	productPhotoFront	2017-05-18 00:28:59.763+00	2017-05-18 00:28:59.763+00	\N	\N	\N	\N	132	\N	\N	\N
345	rpstore/GWBloodAngelsChaplainwithJumpPack/	\N	IMG_1219.JPG	15861	image/jpeg	productPhotoBack	2017-05-18 00:28:59.919+00	2017-05-18 00:28:59.919+00	\N	\N	\N	\N	132	\N	\N	\N
346	rpstore/GWDeathCompany/	\N	IMG_1220.JPG	24437	image/jpeg	productPhotoFront	2017-05-18 00:30:55.791+00	2017-05-18 00:30:55.791+00	\N	\N	\N	\N	133	\N	\N	\N
347	rpstore/GWDeathCompany/	\N	IMG_1220.JPG	24437	image/jpeg	productPhotoBack	2017-05-18 00:30:55.972+00	2017-05-18 00:30:55.972+00	\N	\N	\N	\N	133	\N	\N	\N
348	rpstore/GWBloodAngelsCaptaininTerminatorArmour/	\N	IMG_1221.JPG	24220	image/jpeg	productPhotoFront	2017-05-18 00:34:16.57+00	2017-05-18 00:34:16.57+00	\N	\N	\N	\N	134	\N	\N	\N
349	rpstore/GWBloodAngelsCaptaininTerminatorArmour/	\N	IMG_1221.JPG	24220	image/jpeg	productPhotoBack	2017-05-18 00:34:16.742+00	2017-05-18 00:34:16.742+00	\N	\N	\N	\N	134	\N	\N	\N
350	rpstore/GWDeathwingKnights/	\N	IMG_1222.JPG	22089	image/jpeg	productPhotoBack	2017-05-18 00:42:11.201+00	2017-05-18 00:42:11.201+00	\N	\N	\N	\N	135	\N	\N	\N
351	rpstore/GWDeathwingKnights/	\N	IMG_1222.JPG	22089	image/jpeg	productPhotoFront	2017-05-18 00:42:11.366+00	2017-05-18 00:42:11.366+00	\N	\N	\N	\N	135	\N	\N	\N
352	rpstore/GWRavenwingDarkTalon/	\N	IMG_1223.JPG	13707	image/jpeg	productPhotoFront	2017-05-18 00:45:30.453+00	2017-05-18 00:45:30.453+00	\N	\N	\N	\N	136	\N	\N	\N
353	rpstore/GWRavenwingDarkTalon/	\N	IMG_1223.JPG	13707	image/jpeg	productPhotoBack	2017-05-18 00:45:30.624+00	2017-05-18 00:45:30.624+00	\N	\N	\N	\N	136	\N	\N	\N
354	rpstore/GWRavenwingBlackKnights/	\N	IMG_1224.JPG	21613	image/jpeg	productPhotoFront	2017-05-18 02:44:33.953+00	2017-05-18 02:44:33.953+00	\N	\N	\N	\N	137	\N	\N	\N
355	rpstore/GWRavenwingBlackKnights/	\N	IMG_1224.JPG	21613	image/jpeg	productPhotoBack	2017-05-18 02:44:34.128+00	2017-05-18 02:44:34.128+00	\N	\N	\N	\N	137	\N	\N	\N
356	rpstore/GWRavenwingDarkshroud/	\N	IMG_1225.JPG	15832	image/jpeg	productPhotoFront	2017-05-18 02:48:02.679+00	2017-05-18 02:48:02.679+00	\N	\N	\N	\N	138	\N	\N	\N
357	rpstore/GWRavenwingDarkshroud/	\N	IMG_1225.JPG	15832	image/jpeg	productPhotoBack	2017-05-18 02:48:02.859+00	2017-05-18 02:48:02.859+00	\N	\N	\N	\N	138	\N	\N	\N
358	rpstore/GWBelial/	\N	IMG_1226.JPG	16856	image/jpeg	productPhotoFront	2017-05-18 02:51:37.279+00	2017-05-18 02:51:37.279+00	\N	\N	\N	\N	139	\N	\N	\N
359	rpstore/GWBelial/	\N	IMG_1226.JPG	16856	image/jpeg	productPhotoBack	2017-05-18 02:51:37.476+00	2017-05-18 02:51:37.476+00	\N	\N	\N	\N	139	\N	\N	\N
360	rpstore/GWNephilimJetfighter/	\N	IMG_1227.JPG	12052	image/jpeg	productPhotoBack	2017-05-18 02:55:31.241+00	2017-05-18 02:55:31.241+00	\N	\N	\N	\N	140	\N	\N	\N
361	rpstore/GWNephilimJetfighter/	\N	IMG_1227.JPG	12052	image/jpeg	productPhotoFront	2017-05-18 02:55:31.398+00	2017-05-18 02:55:31.398+00	\N	\N	\N	\N	140	\N	\N	\N
362	rpstore/GWLandSpeederVengeance/	\N	IMG_1228.JPG	15255	image/jpeg	productPhotoFront	2017-05-18 02:58:28.539+00	2017-05-18 02:58:28.539+00	\N	\N	\N	\N	141	\N	\N	\N
363	rpstore/GWLandSpeederVengeance/	\N	IMG_1228.JPG	15255	image/jpeg	productPhotoBack	2017-05-18 02:58:28.711+00	2017-05-18 02:58:28.711+00	\N	\N	\N	\N	141	\N	\N	\N
364	rpstore/GWDeathwingCommandSquad/	\N	IMG_1229.JPG	22743	image/jpeg	productPhotoFront	2017-05-18 03:01:43.596+00	2017-05-18 03:01:43.596+00	\N	\N	\N	\N	142	\N	\N	\N
365	rpstore/GWDeathwingCommandSquad/	\N	IMG_1229.JPG	22743	image/jpeg	productPhotoBack	2017-05-18 03:01:43.769+00	2017-05-18 03:01:43.769+00	\N	\N	\N	\N	142	\N	\N	\N
366	rpstore/GWDeathwingTerminatorSquad/	\N	IMG_1230.JPG	24006	image/jpeg	productPhotoFront	2017-05-18 03:05:24.714+00	2017-05-18 03:05:24.714+00	\N	\N	\N	\N	143	\N	\N	\N
367	rpstore/GWDeathwingTerminatorSquad/	\N	IMG_1230.JPG	24006	image/jpeg	productPhotoBack	2017-05-18 03:05:24.885+00	2017-05-18 03:05:24.885+00	\N	\N	\N	\N	143	\N	\N	\N
368	rpstore/GWRavenwingCommandSquad/	\N	IMG_1231.JPG	24264	image/jpeg	productPhotoFront	2017-05-18 03:08:07.681+00	2017-05-18 03:08:07.681+00	\N	\N	\N	\N	144	\N	\N	\N
369	rpstore/GWRavenwingCommandSquad/	\N	IMG_1231.JPG	24264	image/jpeg	productPhotoBack	2017-05-18 03:08:07.84+00	2017-05-18 03:08:07.84+00	\N	\N	\N	\N	144	\N	\N	\N
370	rpstore/GWRavenwingBikeSquadron/	\N	IMG_1232.JPG	21863	image/jpeg	productPhotoFront	2017-05-18 03:12:08.903+00	2017-05-18 03:12:08.903+00	\N	\N	\N	\N	145	\N	\N	\N
371	rpstore/GWRavenwingBikeSquadron/	\N	IMG_1232.JPG	21863	image/jpeg	productPhotoBack	2017-05-18 03:12:09.081+00	2017-05-18 03:12:09.081+00	\N	\N	\N	\N	145	\N	\N	\N
372	rpstore/GWDarkAngelsCompanyVeteransSquad/	\N	IMG_1233.JPG	26286	image/jpeg	productPhotoFront	2017-05-18 03:16:13.291+00	2017-05-18 03:16:13.291+00	\N	\N	\N	\N	146	\N	\N	\N
373	rpstore/GWDarkAngelsCompanyVeteransSquad/	\N	IMG_1233.JPG	26286	image/jpeg	productPhotoBack	2017-05-18 03:16:13.479+00	2017-05-18 03:16:13.479+00	\N	\N	\N	\N	146	\N	\N	\N
374	rpstore/GWFallen/	\N	IMG_1234.JPG	26204	image/jpeg	productPhotoBack	2017-05-18 03:18:17.818+00	2017-05-18 03:18:17.818+00	\N	\N	\N	\N	147	\N	\N	\N
375	rpstore/GWFallen/	\N	IMG_1234.JPG	26204	image/jpeg	productPhotoFront	2017-05-18 03:18:17.984+00	2017-05-18 03:18:17.984+00	\N	\N	\N	\N	147	\N	\N	\N
376	rpstore/GWDarkAngelsInterrogatorChaplin/	\N	IMG_1235.JPG	15872	image/jpeg	productPhotoFront	2017-05-18 03:23:45.191+00	2017-05-18 03:23:45.191+00	\N	\N	\N	\N	148	\N	\N	\N
377	rpstore/GWDarkAngelsInterrogatorChaplin/	\N	IMG_1235.JPG	15872	image/jpeg	productPhotoBack	2017-05-18 03:23:45.373+00	2017-05-18 03:23:45.373+00	\N	\N	\N	\N	148	\N	\N	\N
378	rpstore/GWNemesis Dreadknight/	\N	IMG_1236.JPG	18277	image/jpeg	productPhotoFront	2017-05-18 19:36:54.465+00	2017-05-18 19:36:54.465+00	\N	\N	\N	\N	149	\N	\N	\N
379	rpstore/GWNemesis Dreadknight/	\N	IMG_1236.JPG	18277	image/jpeg	productPhotoBack	2017-05-18 19:36:54.635+00	2017-05-18 19:36:54.635+00	\N	\N	\N	\N	149	\N	\N	\N
380	rpstore/GWGreyKnightsStrikeSquad/	\N	IMG_1237.JPG	24083	image/jpeg	productPhotoFront	2017-05-18 19:39:48.08+00	2017-05-18 19:39:48.08+00	\N	\N	\N	\N	150	\N	\N	\N
381	rpstore/GWGreyKnightsStrikeSquad/	\N	IMG_1237.JPG	24083	image/jpeg	productPhotoBack	2017-05-18 19:39:48.267+00	2017-05-18 19:39:48.267+00	\N	\N	\N	\N	150	\N	\N	\N
382	rpstore/GWGreyKnightsPurifiers/	\N	IMG_1238.JPG	27872	image/jpeg	productPhotoFront	2017-05-18 19:42:57.347+00	2017-05-18 19:42:57.347+00	\N	\N	\N	\N	151	\N	\N	\N
383	rpstore/GWGreyKnightsPurifiers/	\N	IMG_1238.JPG	27872	image/jpeg	productPhotoBack	2017-05-18 19:42:57.518+00	2017-05-18 19:42:57.518+00	\N	\N	\N	\N	151	\N	\N	\N
384	rpstore/GWGreyKnightsInterceptorSquad/	\N	IMG_1239.JPG	25073	image/jpeg	productPhotoFront	2017-05-18 19:46:38.524+00	2017-05-18 19:46:38.524+00	\N	\N	\N	\N	152	\N	\N	\N
385	rpstore/GWGreyKnightsInterceptorSquad/	\N	IMG_1239.JPG	25073	image/jpeg	productPhotoBack	2017-05-18 19:46:38.691+00	2017-05-18 19:46:38.691+00	\N	\N	\N	\N	152	\N	\N	\N
386	rpstore/GWGreyKnightsPurgationSquad/	\N	IMG_1240.JPG	29401	image/jpeg	productPhotoFront	2017-05-18 19:49:44.719+00	2017-05-18 19:49:44.719+00	\N	\N	\N	\N	153	\N	\N	\N
387	rpstore/GWGreyKnightsPurgationSquad/	\N	IMG_1240.JPG	29401	image/jpeg	productPhotoBack	2017-05-18 19:49:44.874+00	2017-05-18 19:49:44.874+00	\N	\N	\N	\N	153	\N	\N	\N
388	rpstore/GWGreyKnightsTerminators/	\N	IMG_1241.JPG	23368	image/jpeg	productPhotoFront	2017-05-18 19:53:30.642+00	2017-05-18 19:53:30.642+00	\N	\N	\N	\N	154	\N	\N	\N
389	rpstore/GWGreyKnightsTerminators/	\N	IMG_1241.JPG	23368	image/jpeg	productPhotoBack	2017-05-18 19:53:30.814+00	2017-05-18 19:53:30.814+00	\N	\N	\N	\N	154	\N	\N	\N
390	rpstore/GWGreyKnightsPaladins/	\N	IMG_1242.JPG	27947	image/jpeg	productPhotoFront	2017-05-18 19:56:04.337+00	2017-05-18 19:56:04.337+00	\N	\N	\N	\N	155	\N	\N	\N
391	rpstore/GWGreyKnightsPaladins/	\N	IMG_1242.JPG	27947	image/jpeg	productPhotoBack	2017-05-18 19:56:04.513+00	2017-05-18 19:56:04.513+00	\N	\N	\N	\N	155	\N	\N	\N
392	rpstore/GWGreyKnightsStrikeSquad5/	\N	IMG_1243.JPG	27873	image/jpeg	productPhotoFront	2017-05-18 19:59:52.453+00	2017-05-18 19:59:52.453+00	\N	\N	\N	\N	156	\N	\N	\N
393	rpstore/GWGreyKnightsStrikeSquad5/	\N	IMG_1243.JPG	27873	image/jpeg	productPhotoBack	2017-05-18 19:59:52.612+00	2017-05-18 19:59:52.612+00	\N	\N	\N	\N	156	\N	\N	\N
394	rpstore/GWBjorntheFellHanded/	\N	IMG_1244.JPG	20213	image/jpeg	productPhotoFront	2017-05-18 20:06:03.268+00	2017-05-18 20:06:03.268+00	\N	\N	\N	\N	157	\N	\N	\N
395	rpstore/GWBjorntheFellHanded/	\N	IMG_1244.JPG	20213	image/jpeg	productPhotoBack	2017-05-18 20:06:03.437+00	2017-05-18 20:06:03.437+00	\N	\N	\N	\N	157	\N	\N	\N
396	rpstore/GWLoganGrimnarOnStormrider/	\N	IMG_1245.JPG	17162	image/jpeg	productPhotoFront	2017-05-18 21:20:07.802+00	2017-05-18 21:20:07.802+00	\N	\N	\N	\N	158	\N	\N	\N
397	rpstore/GWLoganGrimnarOnStormrider/	\N	IMG_1245.JPG	17162	image/jpeg	productPhotoBack	2017-05-18 21:20:07.974+00	2017-05-18 21:20:07.974+00	\N	\N	\N	\N	158	\N	\N	\N
398	rpstore/GWStartCollectingSpaceWolves/	\N	IMG_1246.JPG	36304	image/jpeg	productPhotoFront	2017-05-18 21:23:29.402+00	2017-05-18 21:23:29.402+00	\N	\N	\N	\N	159	\N	\N	\N
399	rpstore/GWStartCollectingSpaceWolves/	\N	IMG_1246.JPG	36304	image/jpeg	productPhotoBack	2017-05-18 21:23:29.572+00	2017-05-18 21:23:29.572+00	\N	\N	\N	\N	159	\N	\N	\N
400	rpstore/GWThunderwolfCavalry/	\N	IMG_1247.JPG	19555	image/jpeg	productPhotoFront	2017-05-18 21:28:09.493+00	2017-05-18 21:28:09.493+00	\N	\N	\N	\N	160	\N	\N	\N
401	rpstore/GWThunderwolfCavalry/	\N	IMG_1247.JPG	19555	image/jpeg	productPhotoBack	2017-05-18 21:28:09.704+00	2017-05-18 21:28:09.704+00	\N	\N	\N	\N	160	\N	\N	\N
402	rpstore/GWSpaceWolvesPack/	\N	IMG_1248.JPG	25931	image/jpeg	productPhotoBack	2017-05-18 21:30:44.722+00	2017-05-18 21:30:44.722+00	\N	\N	\N	\N	161	\N	\N	\N
403	rpstore/GWSpaceWolvesPack/	\N	IMG_1248.JPG	25931	image/jpeg	productPhotoFront	2017-05-18 21:30:44.887+00	2017-05-18 21:30:44.887+00	\N	\N	\N	\N	161	\N	\N	\N
404	rpstore/GWSpaceWolvesLongFangs/	\N	IMG_1249.JPG	24983	image/jpeg	productPhotoFront	2017-05-18 21:33:38.08+00	2017-05-18 21:33:38.08+00	\N	\N	\N	\N	162	\N	\N	\N
405	rpstore/GWSpaceWolvesLongFangs/	\N	IMG_1249.JPG	24983	image/jpeg	productPhotoBack	2017-05-18 21:33:38.248+00	2017-05-18 21:33:38.248+00	\N	\N	\N	\N	162	\N	\N	\N
406	rpstore/GWWolfGuardTerminators/	\N	IMG_1250.JPG	23978	image/jpeg	productPhotoFront	2017-05-18 21:39:59.641+00	2017-05-18 21:39:59.641+00	\N	\N	\N	\N	163	\N	\N	\N
407	rpstore/GWWolfGuardTerminators/	\N	IMG_1250.JPG	23978	image/jpeg	productPhotoBack	2017-05-18 21:39:59.825+00	2017-05-18 21:39:59.825+00	\N	\N	\N	\N	163	\N	\N	\N
408	rpstore/GWSpaceWolvesWulfen/	\N	IMG_1251.JPG	23481	image/jpeg	productPhotoFront	2017-05-18 21:42:18.398+00	2017-05-18 21:42:18.398+00	\N	\N	\N	\N	164	\N	\N	\N
409	rpstore/GWSpaceWolvesWulfen/	\N	IMG_1251.JPG	23481	image/jpeg	productPhotoBack	2017-05-18 21:42:18.563+00	2017-05-18 21:42:18.563+00	\N	\N	\N	\N	164	\N	\N	\N
410	rpstore/GWStormwolf/	\N	IMG_1252.JPG	19979	image/jpeg	productPhotoFront	2017-05-18 21:44:07.173+00	2017-05-18 21:44:07.173+00	\N	\N	\N	\N	165	\N	\N	\N
411	rpstore/GWStormwolf/	\N	IMG_1252.JPG	19979	image/jpeg	productPhotoBack	2017-05-18 21:44:07.345+00	2017-05-18 21:44:07.345+00	\N	\N	\N	\N	165	\N	\N	\N
412	rpstore/GWStormfangGunship/	\N	IMG_1253.JPG	19719	image/jpeg	productPhotoFront	2017-05-18 21:46:37.315+00	2017-05-18 21:46:37.315+00	\N	\N	\N	\N	166	\N	\N	\N
413	rpstore/GWStormfangGunship/	\N	IMG_1253.JPG	19719	image/jpeg	productPhotoBack	2017-05-18 21:46:37.504+00	2017-05-18 21:46:37.504+00	\N	\N	\N	\N	166	\N	\N	\N
414	rpstore/GWSpaceWolvesVenerableDreadnought/	\N	IMG_1254.JPG	22580	image/jpeg	productPhotoFront	2017-05-18 21:49:14.456+00	2017-05-18 21:49:14.456+00	\N	\N	\N	\N	167	\N	\N	\N
415	rpstore/GWSpaceWolvesVenerableDreadnought/	\N	IMG_1254.JPG	22580	image/jpeg	productPhotoBack	2017-05-18 21:49:14.621+00	2017-05-18 21:49:14.621+00	\N	\N	\N	\N	167	\N	\N	\N
416	rpstore/GWMurderfang/	\N	IMG_1255.JPG	21950	image/jpeg	productPhotoFront	2017-05-18 21:51:05.825+00	2017-05-18 21:51:05.825+00	\N	\N	\N	\N	168	\N	\N	\N
417	rpstore/GWMurderfang/	\N	IMG_1255.JPG	21950	image/jpeg	productPhotoBack	2017-05-18 21:51:06.005+00	2017-05-18 21:51:06.005+00	\N	\N	\N	\N	168	\N	\N	\N
418	rpstore/GWWolfLordOnThunderwolf/	\N	IMG_1256.JPG	19646	image/jpeg	productPhotoBack	2017-05-18 21:53:31.462+00	2017-05-18 21:53:31.462+00	\N	\N	\N	\N	169	\N	\N	\N
419	rpstore/GWWolfLordOnThunderwolf/	\N	IMG_1256.JPG	19646	image/jpeg	productPhotoFront	2017-05-18 21:53:31.616+00	2017-05-18 21:53:31.616+00	\N	\N	\N	\N	169	\N	\N	\N
420	rpstore/GWIronPriest/	\N	IMG_1257.JPG	22225	image/jpeg	productPhotoFront	2017-05-18 21:55:46.384+00	2017-05-18 21:55:46.384+00	\N	\N	\N	\N	170	\N	\N	\N
421	rpstore/GWIronPriest/	\N	IMG_1257.JPG	22225	image/jpeg	productPhotoBack	2017-05-18 21:55:46.549+00	2017-05-18 21:55:46.549+00	\N	\N	\N	\N	170	\N	\N	\N
422	rpstore/GWWolfLordKrom/	\N	IMG_1258.JPG	20122	image/jpeg	productPhotoFront	2017-05-18 21:57:34.732+00	2017-05-18 21:57:34.732+00	\N	\N	\N	\N	171	\N	\N	\N
423	rpstore/GWWolfLordKrom/	\N	IMG_1258.JPG	20122	image/jpeg	productPhotoBack	2017-05-18 21:57:34.915+00	2017-05-18 21:57:34.915+00	\N	\N	\N	\N	171	\N	\N	\N
424	rpstore/GWFenrisianWolves/	\N	IMG_1259.JPG	22061	image/jpeg	productPhotoFront	2017-05-18 22:01:13.38+00	2017-05-18 22:01:13.38+00	\N	\N	\N	\N	172	\N	\N	\N
425	rpstore/GWFenrisianWolves/	\N	IMG_1259.JPG	22061	image/jpeg	productPhotoBack	2017-05-18 22:01:13.566+00	2017-05-18 22:01:13.566+00	\N	\N	\N	\N	172	\N	\N	\N
\.


--
-- Name: Files_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Files_id_seq"', 426, true);


--
-- Data for Name: GameSystemRankings; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "GameSystemRankings" (id, "totalWins", "totalLosses", "totalDraws", "createdAt", "updatedAt", "GameSystemId", "UserId") FROM stdin;
4	7	0	0	2016-10-21 16:45:13.573+00	2016-10-21 16:45:13.573+00	69	5
3	26	1	2	2016-10-21 16:44:37.514+00	2016-10-21 16:52:57.503+00	22	5
5	1	0	0	2016-11-02 23:53:15.639+00	2016-11-02 23:53:15.639+00	61	28
6	0	1	0	2016-11-02 23:54:33.811+00	2016-11-02 23:54:33.811+00	61	5
7	1	0	0	2016-11-05 01:44:33.346+00	2016-11-05 01:44:33.346+00	57	27
1	0	0	0	2016-10-20 22:14:19.356+00	2016-10-22 00:57:41.46+00	69	\N
2	48	2	4	2016-10-20 22:29:11.559+00	2016-10-25 14:52:19.172+00	22	\N
11	2	1	4	2017-04-20 00:59:27.174+00	2017-04-20 01:00:36.09+00	22	81
12	2	1	0	2017-06-24 20:47:50.567+00	2017-06-24 20:47:50.567+00	22	31
13	2	1	0	2017-06-24 20:51:08.7+00	2017-06-24 20:51:08.7+00	22	12
14	2	1	0	2017-06-24 20:51:51.505+00	2017-06-24 20:51:51.505+00	22	93
\.


--
-- Name: GameSystemRankings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"GameSystemRankings_id_seq"', 14, true);


--
-- Data for Name: GameSystems; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "GameSystems" (id, name, description, url, "createdAt", "updatedAt", "UserRankingId", "ManufacturerId") FROM stdin;
1	General Table-Top	\N	\N	2016-10-15 17:56:17.188+00	2016-10-15 18:24:18.122+00	\N	1
2	Chess	\N	\N	2016-10-15 18:26:28.897+00	2016-10-15 18:26:28.897+00	\N	1
3	DUST Tactics	\N	\N	2016-10-15 18:27:05.929+00	2016-10-15 18:27:05.929+00	\N	1
4	Guildball	\N	\N	2016-10-15 18:28:05.737+00	2016-10-15 18:28:05.737+00	\N	1
5	Batman the Miniatures Game	\N	\N	2016-10-15 18:28:30.475+00	2016-10-15 18:28:30.475+00	\N	1
6	Flames of War	\N	\N	2016-10-15 18:29:03.006+00	2016-10-15 18:29:03.006+00	\N	2
7	Hellderado	\N	\N	2016-10-15 18:29:42.601+00	2016-10-15 18:29:42.601+00	\N	3
8	Wrath of Kings	\N	\N	2016-10-15 18:33:25.115+00	2016-10-15 18:33:25.115+00	\N	4
9	Infinity	\N	\N	2016-10-15 18:34:13.254+00	2016-10-15 18:34:13.254+00	\N	5
10	Dark Age	\N	\N	2016-10-15 18:34:41.004+00	2016-10-15 18:34:41.004+00	\N	6
11	Heavy Gear	\N	\N	2016-10-15 18:35:03.388+00	2016-10-15 18:35:03.388+00	\N	7
12	Star Wars Armada	\N	\N	2016-10-15 18:35:35.306+00	2016-10-15 18:35:35.306+00	\N	8
13	Call of Cthulhu: The Card Game	\N	\N	2016-10-15 18:36:00.297+00	2016-10-15 18:36:00.297+00	\N	8
14	Game of Thrones: The Card Game	\N	\N	2016-10-15 18:36:29.302+00	2016-10-15 18:36:29.302+00	\N	8
15	Netrunner	\N	\N	2016-10-15 18:36:51.884+00	2016-10-15 18:36:51.884+00	\N	8
16	Star Wars Imperial Assault	\N	\N	2016-10-15 18:37:26.913+00	2016-10-15 18:37:26.913+00	\N	8
17	Star Wars: The Card Game	\N	\N	2016-10-15 18:37:56.23+00	2016-10-15 18:37:56.23+00	\N	8
18	Star Wars X-Wing	\N	\N	2016-10-15 18:38:19.737+00	2016-10-15 18:38:19.737+00	\N	8
20	Warhammer: Invasion	\N	\N	2016-10-15 18:39:19.686+00	2016-10-15 18:39:19.686+00	\N	8
21	Horus Heresy	\N	\N	2016-10-15 18:39:51.987+00	2016-10-15 18:39:51.987+00	\N	9
23	The Hobbit/TLOTR	\N	\N	2016-10-15 18:40:46.136+00	2016-10-15 18:40:46.136+00	\N	10
24	Blood Bowl	\N	\N	2016-10-15 18:41:10.039+00	2016-10-15 18:41:10.039+00	\N	10
25	Age of Sigmar	\N	\N	2016-10-15 18:41:38.526+00	2016-10-15 18:41:38.526+00	\N	10
36	Epic 40K	\N	\N	2016-10-15 18:42:10.478+00	2016-10-15 18:42:10.478+00	\N	10
37	Battle Fleet Gothic	\N	\N	2016-10-15 18:42:41.72+00	2016-10-15 18:42:41.72+00	\N	10
39	Bushido	\N	\N	2016-10-15 18:43:28.054+00	2016-10-15 18:43:28.054+00	\N	11
40	Drop Zone Commander	\N	\N	2016-10-15 18:44:09.648+00	2016-10-15 18:44:09.648+00	\N	12
41	Drop Fleet Commander	\N	\N	2016-10-15 18:44:42.216+00	2016-10-15 18:44:42.216+00	\N	12
42	Dead Zone	\N	\N	2016-10-15 18:45:12.378+00	2016-10-15 18:45:12.378+00	\N	13
43	Dread Ball	\N	\N	2016-10-15 18:45:43.12+00	2016-10-15 18:45:43.12+00	\N	13
44	King of War	\N	\N	2016-10-15 18:46:03.233+00	2016-10-15 18:46:03.233+00	\N	13
45	Warpath	\N	\N	2016-10-15 18:46:21.982+00	2016-10-15 18:46:21.982+00	\N	13
46	Relic Knights	\N	\N	2016-10-15 18:46:45.754+00	2016-10-15 18:46:45.754+00	\N	14
47	Wild West Exodus	\N	\N	2016-10-15 18:47:19.902+00	2016-10-15 18:47:19.902+00	\N	15
48	Robotech Tactics	\N	\N	2016-10-15 18:47:50.363+00	2016-10-15 18:47:50.363+00	\N	16
49	Warmachine/Hordes	\N	\N	2016-10-15 18:48:21.87+00	2016-10-15 18:48:21.87+00	\N	17
50	Warzone	\N	\N	2016-10-15 18:48:44.61+00	2016-10-15 18:48:44.61+00	\N	18
51	Last Saga	\N	\N	2016-10-15 18:49:16.406+00	2016-10-15 18:49:16.406+00	\N	19
52	Dystopian Legions	\N	\N	2016-10-15 18:49:43.619+00	2016-10-15 18:49:43.619+00	\N	20
53	Dystopian Wars	\N	\N	2016-10-15 18:50:16.971+00	2016-10-15 18:50:16.971+00	\N	20
54	Firestorm Armada	\N	\N	2016-10-15 18:50:41.885+00	2016-10-15 18:50:41.885+00	\N	20
55	Firestorm Planetfall	\N	\N	2016-10-15 18:51:21.407+00	2016-10-15 18:51:21.407+00	\N	20
56	Armoured Clash	\N	\N	2016-10-15 18:52:05.182+00	2016-10-15 18:52:05.182+00	\N	20
57	Halo Fleet Battles	\N	\N	2016-10-15 18:52:32.163+00	2016-10-15 18:52:32.163+00	\N	20
58	Maelstrom's Edge	\N	\N	2016-10-15 18:53:17.711+00	2016-10-15 18:53:17.711+00	\N	21
59	Saga	\N	\N	2016-10-15 18:53:50.347+00	2016-10-15 18:53:50.347+00	\N	22
60	Black Powder	\N	\N	2016-10-15 18:54:20.215+00	2016-10-15 18:54:20.215+00	\N	23
61	Bolt Action	\N	\N	2016-10-15 18:55:11.247+00	2016-10-15 18:55:11.247+00	\N	23
62	Hail Caesar	\N	\N	2016-10-15 18:55:42.418+00	2016-10-15 18:55:42.418+00	\N	23
63	Pike & Shotte	\N	\N	2016-10-15 18:56:31.533+00	2016-10-15 18:56:31.533+00	\N	23
64	Beyond the Gates of Antares	\N	\N	2016-10-15 18:57:01.143+00	2016-10-15 18:57:01.143+00	\N	23
65	Magic The Gathering	\N	\N	2016-10-15 18:57:27.096+00	2016-10-15 18:57:27.096+00	\N	24
66	D&D Attack Wing	\N	\N	2016-10-15 18:58:04.602+00	2016-10-15 18:58:04.602+00	\N	25
67	Hero Clicks	\N	\N	2016-10-15 18:58:28.457+00	2016-10-15 18:58:28.457+00	\N	25
68	Star Trek Attack Wing	\N	\N	2016-10-15 18:58:56.003+00	2016-10-15 18:58:56.003+00	\N	25
69	Malifaux	\N	\N	2016-10-15 18:59:22.371+00	2016-10-15 18:59:22.371+00	\N	26
70	Kill Team	\N	\N	2016-10-19 22:31:34.417+00	2016-10-19 22:31:34.417+00	\N	10
22	Warhammer 40K	Warhammer	http://warhammer.com/	2016-10-15 18:40:21.449+00	2017-04-22 18:15:34.826+00	\N	10
38	Shadow War: Armaggedon	\N	\N	2016-10-15 18:43:03.974+00	2017-05-24 18:19:46.851+00	\N	10
\.


--
-- Name: GameSystems_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"GameSystems_id_seq"', 72, true);


--
-- Data for Name: Manufacturers; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "Manufacturers" (id, name, description, url, "createdAt", "updatedAt") FROM stdin;
1	Miscellaneous	\N	\N	2016-10-15 16:55:22.169+00	2016-10-15 17:00:35.324+00
2	Battlefront Miniatures	\N	\N	2016-10-15 17:03:30.648+00	2016-10-15 17:03:30.648+00
3	Cipher Studios	\N	\N	2016-10-15 17:04:35.545+00	2016-10-15 17:04:35.545+00
4	Cool Mini or Not	\N	\N	2016-10-15 17:05:15.891+00	2016-10-15 17:05:15.891+00
5	Corvus Belli	\N	\N	2016-10-15 17:05:42.835+00	2016-10-15 17:05:42.835+00
6	Dark Age Miniatures	\N	\N	2016-10-15 17:06:03.79+00	2016-10-15 17:06:03.79+00
7	Dream Pod 9	\N	\N	2016-10-15 17:06:32.267+00	2016-10-15 17:06:32.267+00
8	Fantasy Flight Games	\N	\N	2016-10-15 17:06:48.102+00	2016-10-15 17:06:48.102+00
9	Forge World (Games Workshop)	\N	\N	2016-10-15 17:08:57.221+00	2016-10-15 17:08:57.221+00
10	Games Workshop	\N	\N	2016-10-15 17:10:22.544+00	2016-10-15 17:10:22.544+00
11	GCT Studios	\N	\N	2016-10-15 17:10:45.784+00	2016-10-15 17:10:45.784+00
12	Hawk Wargames	\N	\N	2016-10-15 17:11:23.02+00	2016-10-15 17:11:23.02+00
13	Mantic	\N	\N	2016-10-15 17:11:40.167+00	2016-10-15 17:11:40.167+00
14	Ninja Division	\N	\N	2016-10-15 17:12:01.136+00	2016-10-15 17:12:01.136+00
15	Outlaw Games	\N	\N	2016-10-15 17:12:24.165+00	2016-10-15 17:12:24.165+00
16	Palladium Books	\N	\N	2016-10-15 17:12:52.712+00	2016-10-15 17:12:52.712+00
17	Privateer Press	\N	\N	2016-10-15 17:13:14.638+00	2016-10-15 17:13:14.638+00
18	Prodos	\N	\N	2016-10-15 17:13:31.362+00	2016-10-15 17:13:31.362+00
19	Rocket Games	\N	\N	2016-10-15 17:13:45.004+00	2016-10-15 17:13:45.004+00
20	Spartan Games	\N	\N	2016-10-15 17:14:01.256+00	2016-10-15 17:14:01.256+00
21	Spiral Arm Studios	\N	\N	2016-10-15 17:14:25.056+00	2016-10-15 17:14:25.056+00
22	Tomahawk Studios	\N	\N	2016-10-15 17:14:50.753+00	2016-10-15 17:14:50.753+00
23	Warlord Games	\N	\N	2016-10-15 17:15:10.775+00	2016-10-15 17:15:10.775+00
24	Wizards of the Coast (Hasbro)	\N	\N	2016-10-15 17:15:31.544+00	2016-10-15 17:15:31.544+00
25	Wizkids	\N	\N	2016-10-15 17:15:59.108+00	2016-10-15 17:15:59.108+00
26	Wyrd		\N	2016-10-15 17:16:15.085+00	2017-04-22 18:35:53.822+00
\.


--
-- Name: Manufacturers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Manufacturers_id_seq"', 33, true);


--
-- Data for Name: NewsPosts; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "NewsPosts" (id, title, image, callout, body, published, featured, tags, "gameSystem", category, "createdAt", "updatedAt", "UserId", "ManufacturerId", "FactionId", "GameSystemId") FROM stdin;
1	RP Store Testings	1475884859682-plaque-logo.png	We're getting excited to start user testing of the Reward Point Store next weekend! We'll be providing additional info for people interested in helping us with user testing the beginning of next week.\nAs a Battle-comm member you will earn Reward Points in various ways (running/paparticipating in tournaments, hobby workshops, demos, etc.) at your local gaming store and gaming conventions that are then deposited in your Battle-comm Reward Point Stash. You can then purchase hobby and tabletop gaming product for Reward Points In the Battle-comm Reward Point Store.\n100 Battle-comm Reward Points = $1\nFree shipping\nWe will start providing additional details about the Battle-comm service this weekend!\nBryce	We're getting excited to start user testing of the Reward Point Store next weekend! We'll be providing additional info for people interested in helping us with user testing the beginning of next week.\nAs a Battle-comm member you will earn Reward Points in various ways (running/paparticipating in tournaments, hobby workshops, demos, etc.) at your local gaming store and gaming conventions that are then deposited in your Battle-comm Reward Point Stash. You can then purchase hobby and tabletop gaming product for Reward Points In the Battle-comm Reward Point Store.\n100 Battle-comm Reward Points = $1\nFree shipping\nWe will start providing additional details about the Battle-comm service this weekend!\nBryce	t	f	general, testing, news	mnu901CHESS	events	2016-10-07 22:58:03.463+00	2017-04-22 19:45:23.908+00	3	1	\N	1
\.


--
-- Name: NewsPosts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"NewsPosts_id_seq"', 7, true);


--
-- Data for Name: ProductOrders; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "ProductOrders" (id, status, "orderTotal", "customerFullName", "customerEmail", phone, "shippingStreet", "shippingApartment", "shippingCity", "shippingState", "shippingZip", "shippingCountry", "createdAt", "updatedAt", "UserId", "productDetails", "orderDetails") FROM stdin;
1	processing	2250	Zack Thomas	zanselm5@gmail.com	3175448348	530 E Ohio St Apt. 204	\N	Indianapolis	IN	46204	US	2017-04-27 02:00:56.54+00	2017-04-27 02:00:56.54+00	3	[{"id": 1, "SKU": "0000001", "qty": 9, "name": "Great Escape Games 5% Discount", "tags": "FLGS, discount, Great Escape Games", "Files": [{"id": 24, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.689Z", "updatedAt": "2017-04-19T00:50:24.689Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 25, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.691Z", "updatedAt": "2017-04-19T00:50:24.691Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 250, "category": "Misc.", "isOnSale": false, "stockQty": 1000000, "FactionId": 20, "createdAt": "2016-10-07T17:57:31.774Z", "isInStock": true, "updatedAt": "2017-04-24T01:49:49.297Z", "isFeatured": true, "description": "5% off a $ purchase with Great Escape Games", "isDisplayed": true, "GameSystemId": 22, "ManufacturerId": 10}]	These are some order details
2	shipped	2250	Zack Thomas	zanselm5@gmail.com	3175448348	530 E Ohio St Apt. 204	\N	Indianapolis	IN	46204	US	2017-04-27 02:02:20.079+00	2017-04-27 11:57:18.969+00	3	[{"id": 1, "SKU": "0000001", "qty": 9, "name": "Great Escape Games 5% Discount", "tags": "FLGS, discount, Great Escape Games", "Files": [{"id": 24, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.689Z", "updatedAt": "2017-04-19T00:50:24.689Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 25, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.691Z", "updatedAt": "2017-04-19T00:50:24.691Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 250, "category": "Misc.", "isOnSale": false, "stockQty": 1000000, "FactionId": 20, "createdAt": "2016-10-07T17:57:31.774Z", "isInStock": true, "updatedAt": "2017-04-24T01:49:49.297Z", "isFeatured": true, "description": "5% off a $ purchase with Great Escape Games", "isDisplayed": true, "GameSystemId": 22, "ManufacturerId": 10}]	These are some order details
3	processing	5500	Bryce Nelson	bnelson@battle-comm.com	916 882 0351	3624 Jenny Lind Ave.	\N	North highlands 	California 	95660	US	2017-05-04 23:09:56.707+00	2017-05-04 23:09:56.707+00	5	[{"id": 6, "SKU": "fdsa", "qty": 1, "name": "Test 2", "tags": "cipher studios", "Files": [{"id": 62, "name": "product-test.jpeg", "size": 269691, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 6, "createdAt": "2017-04-29T15:23:50.310Z", "updatedAt": "2017-04-29T15:23:50.310Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/fdsa/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 63, "name": "product-test.jpeg", "size": 269691, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 6, "createdAt": "2017-04-29T15:23:50.318Z", "updatedAt": "2017-04-29T15:23:50.318Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/fdsa/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 5000, "category": "cipher studios", "isOnSale": true, "stockQty": 100, "FactionId": null, "createdAt": "2017-04-29T13:20:05.855Z", "isInStock": true, "updatedAt": "2017-04-29T13:20:05.855Z", "isFeatured": true, "description": "This is another product test.", "isDisplayed": true, "GameSystemId": 7, "ManufacturerId": 3}, {"id": 1, "SKU": "0000001", "qty": 2, "name": "Great Escape Games 5% Discount", "tags": "FLGS, discount, Great Escape Games", "Files": [{"id": 24, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.689Z", "updatedAt": "2017-04-19T00:50:24.689Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 25, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.691Z", "updatedAt": "2017-04-19T00:50:24.691Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 250, "category": "Misc.", "isOnSale": false, "stockQty": 1000000, "FactionId": 20, "createdAt": "2016-10-07T17:57:31.774Z", "isInStock": true, "updatedAt": "2017-04-24T01:49:49.297Z", "isFeatured": true, "description": "5% off a $ purchase with Great Escape Games", "isDisplayed": true, "GameSystemId": 22, "ManufacturerId": 10}]	I want my stuffs!
4	processing	15000	Zack Anselm	zanselm5@gmail.com		1110 Linden St	A	Indianapolis	IN	46203	US	2017-05-05 11:13:24.688+00	2017-05-05 11:13:24.688+00	81	[{"id": 6, "SKU": "fdsa", "qty": 3, "name": "Test 2", "tags": "cipher studios", "Files": [{"id": 62, "name": "product-test.jpeg", "size": 269691, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 6, "createdAt": "2017-04-29T15:23:50.310Z", "updatedAt": "2017-04-29T15:23:50.310Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/fdsa/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 63, "name": "product-test.jpeg", "size": 269691, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 6, "createdAt": "2017-04-29T15:23:50.318Z", "updatedAt": "2017-04-29T15:23:50.318Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/fdsa/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 5000, "category": "cipher studios", "isOnSale": true, "stockQty": 100, "FactionId": null, "createdAt": "2017-04-29T13:20:05.855Z", "isInStock": true, "updatedAt": "2017-04-29T13:20:05.855Z", "isFeatured": true, "description": "This is another product test.", "isDisplayed": true, "GameSystemId": 7, "ManufacturerId": 3}]	Test purchase
5	processing	2300	System Admin	systemAdmin@email.com	3213212322	1110 Linden St	\N	Indianapolis	Indiana (IN)	46203	US	2017-05-05 11:56:20.325+00	2017-05-05 11:56:20.325+00	3	[{"id": 7, "SKU": "fdas", "qty": 1, "name": "Product Test", "tags": "product, test", "Files": [{"id": 65, "name": "prints2.jpg", "size": 218510, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 7, "createdAt": "2017-05-05T11:54:47.754Z", "updatedAt": "2017-05-05T11:54:47.754Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/fdas/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 66, "name": "prints2.jpg", "size": 218510, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 7, "createdAt": "2017-05-05T11:54:47.760Z", "updatedAt": "2017-05-05T11:54:47.760Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/fdas/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Black", "isNew": true, "price": 2300, "category": "Table-Top", "isOnSale": true, "stockQty": 100, "FactionId": 23, "createdAt": "2017-05-05T11:54:47.402Z", "isInStock": true, "updatedAt": "2017-05-05T11:54:47.402Z", "isFeatured": true, "description": "This is a new product test.  O boy!", "isDisplayed": true, "GameSystemId": 61, "ManufacturerId": 23}]	Something something something
6	processing	3750	Bryce Nelson	biffster72@gmail.com	916 882 0351	3624 Jenny Lind Ave 	\N	North highlands 	California 	95660	US	2017-05-07 14:03:08.442+00	2017-05-07 14:03:08.442+00	5	[{"id": 7, "SKU": "fdas", "qty": 1, "name": "Product Test", "tags": "product, test", "Files": [{"id": 65, "name": "prints2.jpg", "size": 218510, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 7, "createdAt": "2017-05-05T11:54:47.754Z", "updatedAt": "2017-05-05T11:54:47.754Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/fdas/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 66, "name": "prints2.jpg", "size": 218510, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 7, "createdAt": "2017-05-05T11:54:47.760Z", "updatedAt": "2017-05-05T11:54:47.760Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/fdas/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Black", "isNew": true, "price": 2300, "category": "Table-Top", "isOnSale": true, "stockQty": 100, "FactionId": 23, "createdAt": "2017-05-05T11:54:47.402Z", "isInStock": true, "updatedAt": "2017-05-05T11:54:47.402Z", "isFeatured": true, "description": "This is a new product test.  O boy!", "isDisplayed": true, "GameSystemId": 61, "ManufacturerId": 23}, {"id": 5, "SKU": "abcd", "qty": 1, "name": "Test Product", "tags": "games, craftworld eldar", "Files": [{"id": 60, "name": "Prints.jpg", "size": 529001, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 5, "createdAt": "2017-04-29T15:23:10.813Z", "updatedAt": "2017-04-29T15:23:10.813Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/abcd/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 61, "name": "Prints.jpg", "size": 529001, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 5, "createdAt": "2017-04-29T15:23:10.818Z", "updatedAt": "2017-04-29T15:23:10.818Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/abcd/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Blue", "isNew": true, "price": 1200, "category": "games", "isOnSale": true, "stockQty": 100, "FactionId": 21, "createdAt": "2017-04-29T13:14:45.583Z", "isInStock": true, "updatedAt": "2017-04-29T13:14:45.583Z", "isFeatured": true, "description": "This is one cool product.  Would ya look at that!", "isDisplayed": true, "GameSystemId": 22, "ManufacturerId": 10}, {"id": 1, "SKU": "0000001", "qty": 1, "name": "Great Escape Games 5% Discount", "tags": "FLGS, discount, Great Escape Games", "Files": [{"id": 24, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.689Z", "updatedAt": "2017-04-19T00:50:24.689Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 25, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.691Z", "updatedAt": "2017-04-19T00:50:24.691Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 250, "category": "Misc.", "isOnSale": false, "stockQty": 1000000, "FactionId": 20, "createdAt": "2016-10-07T17:57:31.774Z", "isInStock": true, "updatedAt": "2017-04-24T01:49:49.297Z", "isFeatured": true, "description": "5% off a $ purchase with Great Escape Games", "isDisplayed": true, "GameSystemId": 22, "ManufacturerId": 10}]	Give me my stuff!
7	processing	500	Bryce Nelson	bnelson@battle-comm.com	916 882 0351	3624 Jenny Lind Ave.	\N	North Highlands 	California 	95660	US	2017-05-08 18:22:07.51+00	2017-05-08 18:22:07.51+00	5	[{"id": 1, "SKU": "0000001", "qty": 2, "name": "Great Escape Games 5% Discount", "tags": "FLGS, discount, Great Escape Games", "Files": [{"id": 24, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.689Z", "updatedAt": "2017-04-19T00:50:24.689Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 25, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.691Z", "updatedAt": "2017-04-19T00:50:24.691Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 250, "category": "Misc.", "isOnSale": false, "stockQty": 1000000, "FactionId": 20, "createdAt": "2016-10-07T17:57:31.774Z", "isInStock": true, "updatedAt": "2017-04-24T01:49:49.297Z", "isFeatured": true, "description": "5% off a $ purchase with Great Escape Games", "isDisplayed": true, "GameSystemId": 22, "ManufacturerId": 10}]	My stuff!
8	processing	500	Bryce Nelson	biffster72@gmail.com	916 882 0351	J	\N	N	California 	95660	US	2017-05-08 18:24:12.482+00	2017-05-08 18:24:12.482+00	5	[{"id": 1, "SKU": "0000001", "qty": 2, "name": "Great Escape Games 5% Discount", "tags": "FLGS, discount, Great Escape Games", "Files": [{"id": 24, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.689Z", "updatedAt": "2017-04-19T00:50:24.689Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 25, "name": "default.jpg", "size": 59649, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 1, "createdAt": "2017-04-19T00:50:24.691Z", "updatedAt": "2017-04-19T00:50:24.691Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/0000001/", "GameSystemId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Red", "isNew": true, "price": 250, "category": "Misc.", "isOnSale": false, "stockQty": 1000000, "FactionId": 20, "createdAt": "2016-10-07T17:57:31.774Z", "isInStock": true, "updatedAt": "2017-04-24T01:49:49.297Z", "isFeatured": true, "description": "5% off a $ purchase with Great Escape Games", "isDisplayed": true, "GameSystemId": 22, "ManufacturerId": 10}]	My stuff!
9	processing	4800	Zack Anselm	zanselm5@gmail.com	3232343234	530 E Ohio St Apt 204		Indianapolis	IN	46204	US	2017-05-12 00:20:21.595+00	2017-05-12 00:20:21.595+00	3	[{"id": 5, "SKU": "abcd", "qty": 4, "name": "Test Product", "tags": "games, craftworld eldar", "Files": [{"id": 60, "name": "Prints.jpg", "size": 529001, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 5, "createdAt": "2017-04-29T15:23:10.813Z", "updatedAt": "2017-04-29T15:23:10.813Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/abcd/", "GameSystemId": null, "AchievementId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}, {"id": 61, "name": "Prints.jpg", "size": 529001, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 5, "createdAt": "2017-04-29T15:23:10.818Z", "updatedAt": "2017-04-29T15:23:10.818Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/abcd/", "GameSystemId": null, "AchievementId": null, "BannerSlideId": null, "ManufacturerId": null, "UserAchievementId": null}], "color": "Blue", "isNew": true, "price": 1200, "category": "games", "isOnSale": true, "stockQty": 100, "FactionId": 21, "createdAt": "2017-04-29T13:14:45.583Z", "isInStock": true, "updatedAt": "2017-04-29T13:14:45.583Z", "isFeatured": true, "description": "This is one cool product.  Would ya look at that!", "isDisplayed": true, "GameSystemId": 22, "shippingCost": null, "ManufacturerId": 10}]	\N
10	processing	2300	Zack Anselm	zanselm5@gmail.com	3232343234	1110 Linden St	3	Indianapolis	Indiana (IN)	46203	US	2017-05-14 23:40:54.013+00	2017-05-14 23:40:54.013+00	81	[{"id": 7, "SKU": "fdas", "qty": 1, "name": "Product Test", "tags": "product, test", "Files": [{"id": 65, "name": "prints2.jpg", "size": 218510, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 7, "createdAt": "2017-05-05T11:54:47.754Z", "updatedAt": "2017-05-05T11:54:47.754Z", "NewsPostId": null, "identifier": "productPhotoFront", "locationUrl": "rpstore/fdas/", "GameSystemId": null, "AchievementId": null, "BannerSlideId": null, "ManufacturerId": null}, {"id": 66, "name": "prints2.jpg", "size": 218510, "type": "image/jpeg", "label": null, "UserId": null, "ProductId": 7, "createdAt": "2017-05-05T11:54:47.760Z", "updatedAt": "2017-05-05T11:54:47.760Z", "NewsPostId": null, "identifier": "productPhotoBack", "locationUrl": "rpstore/fdas/", "GameSystemId": null, "AchievementId": null, "BannerSlideId": null, "ManufacturerId": null}], "color": "Black", "isNew": true, "price": 2300, "category": "Table-Top", "isOnSale": true, "stockQty": 100, "FactionId": 23, "createdAt": "2017-05-05T11:54:47.402Z", "isInStock": true, "updatedAt": "2017-05-05T11:54:47.402Z", "isFeatured": true, "description": "This is a new product test.  O boy!", "isDisplayed": true, "GameSystemId": 61, "shippingCost": null, "ManufacturerId": 23}]	Testing
\.


--
-- Name: ProductOrders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"ProductOrders_id_seq"', 10, true);


--
-- Data for Name: Products; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "Products" (id, "SKU", name, price, description, color, tags, category, "stockQty", "filterVal", "createdAt", "updatedAt", "ManufacturerId", "FactionId", "GameSystemId", "isDisplayed", "isFeatured", "isNew", "isOnSale", "shippingCost") FROM stdin;
29	FFGStarViperExpansionPack	StarViper Expansion Pack 	1995	Fantasy Flight Games StarViper Expansion Pack	\N	Fantasy Flight Games, StarViper, Star Wars	Minature 	100	showit	2017-05-17 01:21:43.927+00	2017-05-17 01:21:43.927+00	8	\N	18	t	t	t	t	4
30	FFGIG2000ExpansionPack	IG-2000 Expansion Pack 	2995	Fantasy Flight Games IG-2000 Expansion Pack 	\N	Fantasy Flight Games, IG-2000, Star Wars	Minature 	100	showit	2017-05-17 01:24:37.448+00	2017-05-17 01:24:37.448+00	8	\N	18	t	t	t	t	6
14	FFGTieFighterExpansionPack	Tie Fighter Expansion Pack	1495	Fantasy Flight Games Tie Fighter Expansion Pack	\N	Fantasy Flight Games, Tie Fighter, Star Wars	Minature	100	showit	2017-05-17 00:06:53.327+00	2017-05-17 00:06:53.327+00	8	\N	18	t	t	t	t	4
13	FFGXwing	X-Wing Expansion Pack	1495	Fantasy Flight Games X-Wing Expansion pack	\N	Fantasy Flight Games, X-Wing, Star Wars	Minature	100	showit	2017-05-16 23:55:06.97+00	2017-05-17 00:07:17.639+00	8	\N	18	t	t	t	t	4
15	FFGYwingExpansionPack	Y-Wing Expansion Pack 	1495	Fantasy Flight Games Y-Wing Expansion Pack 	\N	Fantasy Flight Games, Y-Wing, Star Wars	Minature	100	showit	2017-05-17 00:11:03.344+00	2017-05-17 00:11:03.344+00	8	\N	18	t	t	t	t	4
16	FFGTieAdvancedExpansionPack	Tie Advanced Expansion Pack 	1495	Fantasy Flight Games Tie Advanced Expansion Pack 	\N	Fantasy Flight Games, Tie Advanced, Star Wars	Minature	100	showit	2017-05-17 00:14:16.025+00	2017-05-17 00:14:16.025+00	8	\N	18	t	t	t	t	4
17	FFGMillenniumFalconExpansionPack	Millennium Falcon Expansion Pack	2995	Fantasy Flight Games Millennium Falcon Expansion Pack 	\N	Fantasy Flight Games, Millennium Falcon, Star Wars	Minature 	100	showit	2017-05-17 00:18:52.4+00	2017-05-17 00:18:52.4+00	8	\N	18	t	t	t	t	6
18	FFGSlaveOneExpansionPack	Slave One Expansion Pack 	2995	Fantasy Flight Games Slave One Expansion Pack 	\N	Fantasy Flight Games, Slave One, Star Wars	Minature 	100	showit	2017-05-17 00:21:48.845+00	2017-05-17 00:21:48.845+00	8	\N	18	t	t	t	t	6
19	FFGAwingExpansionPack	A-Wing Expansion Pack	1495	Fantasy Flight Games A-Wing Expansion Pack 	\N	Fantasy Flight Games, A-Wing, Star Wars	Minature 	100	showit	2017-05-17 00:24:26.17+00	2017-05-17 00:24:26.17+00	8	\N	18	t	t	t	t	4
20	FFGBwingExpansionPack	B-Wing Expansion Pack	1495	Fantasy Flight Games B-Wing Expansion Pack 	\N	Fantasy Flight Games, B-Wing, Star Wars	Minature 	100	showit	2017-05-17 00:26:58.956+00	2017-05-17 00:26:58.956+00	8	\N	18	t	t	t	t	4
21	FFGTieInterceptorExpansionPack	Tie Interceptor Expansion Pack 	1495	Fantasy Flight Games Tie Interceptor Expansion Pack 	\N	Fantasy Flight Games, Tie Interceptor, Star Wars	Minature 	100	showit	2017-05-17 00:30:05.95+00	2017-05-17 00:30:05.95+00	8	\N	18	t	t	t	t	4
22	FFGHWK290ExpansionPack	HWK-290 Expansion Pack 	1495	Fantasy Flight Games HWK-290 Expansion Pack 	\N	Fantasy Flight Games, HWK-290, Star Wars	Minature 	100	showit	2017-05-17 00:34:18.947+00	2017-05-17 00:34:18.947+00	8	\N	18	t	t	t	t	4
23	FFGLambdaClassShuttleExpansionPack	Lambda-Class Shuttle Expansion Pack 	2995	Fantasy Flight Games Lambda-Class Shuttle Expansion Pack 	\N	Fantasy Flight Games, Lambda-Class Shuttle, Star Wars	Minature 	100	showit	2017-05-17 00:37:47.657+00	2017-05-17 00:37:47.657+00	8	\N	18	t	t	t	t	6
24	FFGTieBomberExpansionPack	Tie Bomber Expansion Pack	1495	Fantasy Flight Games Tie Bomber Expansion Pack	\N	Fantasy Flight Games, Tie Bomber, Star Wars	Minature 	100	showit	2017-05-17 00:40:43.578+00	2017-05-17 00:40:43.578+00	8	\N	18	t	t	t	t	4
25	FFGTieDefenderExpansionPack	Tie Defender Expansion Pack	1495	Fantasy Flight Games Tie Defender Expansion Pack	\N	Fantasy Flight Games, Tie Defender, Star Wars	Minature 	100	showit	2017-05-17 00:44:33.552+00	2017-05-17 00:44:33.552+00	8	\N	18	t	t	t	t	4
11	FFGYT2400	YT-2400 Expansion Pack 	2995	Fantasy Flight Games YT-2400	none	Fantasy Flight Games, YT-2400, Star Wars	minature	100	showit	2017-05-16 17:55:28.249+00	2017-05-17 01:07:42.207+00	8	41	18	t	t	t	t	5
37	FFGTieFoFighterExpansionPack	Tie/fo Fighter Expansion Pack 	1495	Fantasy Flight Games Tie/fo Fighter Expansion Pack 	\N	Fantasy Flight Games, Tie/fo Fighter, Star Wars	Minature 	100	showit	2017-05-17 01:46:41.172+00	2017-05-17 01:46:41.172+00	8	\N	18	t	t	t	t	4
9	FFGInquisitorTieFigher	Inquisitor Tie Expansion Pack 	1495	Fantasy Flight Games Inquisitor Tie Fighter	none	Fantasy Flight Games, Inquisitor Tie Fighter, Star Wars	minature	100	showit	2017-05-16 17:50:05.162+00	2017-05-17 01:08:32.141+00	8	40	18	t	t	t	t	3
8	FFGEwing	E-Wing Expansion Pack 	1495	Fantasy Flight Games E-Wing	None	E-wing, Fantasy Flight Games, Star Wars	minature	100	showit	2017-05-16 17:45:41.747+00	2017-05-17 01:08:49.864+00	8	41	18	t	t	t	t	3
26	FFGZ95HeadhunterExpansionPack	Z-95 Headhunter Expansion Pack 	1495	Fantasy Flight Games Z-95 headhunter Expansion Pack 	\N	Fantasy Flight Games, Z-95 Headhunter, Star Wars	Minature 	100	showit	2017-05-17 01:11:41.921+00	2017-05-17 01:11:41.921+00	8	\N	18	t	t	t	t	4
27	FFGTiePhantomExpansionPack	Tie Phantom Expansion Pack 	1495	Fantasy Flight Games Tie Phantom Expansion Pack 	\N	Fantasy Flight Games, Tie Phantom, Star Wars	Minature 	100	showit	2017-05-17 01:13:47.569+00	2017-05-17 01:13:47.569+00	8	\N	18	t	t	t	t	4
28	FFGVT49DecimatorExpansionPack	VT-49 Decimator Expansion Pack 	3995	Fantasy Flight Games VT-49 Decimator Expansion Pack 	\N	Fantasy Flight Games, VT-49 Decimator, Star Wars	Minature 	100	showit	2017-05-17 01:18:25.055+00	2017-05-17 01:18:25.055+00	8	\N	18	t	t	t	t	6
31	FFGMostWantedExpansionPack	Most Wanted Expansion Pack 	3995	Fantasy Flight Games Most Wanted Expansion Pack 	\N	Fantasy Flight Games, Most Wanted, Star Wars	Minature 	100	showit	2017-05-17 01:27:27.563+00	2017-05-17 01:27:27.563+00	8	\N	18	t	t	t	t	6
32	FFGM3AInterceptorExpansionPack	M3-A Interceptor Expansion Pack 	1495	Fantasy Flight Games M3-A Interceptor Expansion Pack 	\N	Fantasy Flight Games, M3-A Interceptor, Star Wars	Minature 	100	showit	2017-05-17 01:30:34.788+00	2017-05-17 01:30:34.788+00	8	\N	18	t	t	t	t	4
33	FFGHoundsToothExpansionPack	Hound's Tooth Expansion Pack	3995	Fantasy Flight Games Hound's Tooth Expansion Pack 	\N	Fantasy Flight Games, Hound's Tooth, Star Wars	Minature 	100	showit	2017-05-17 01:34:25.569+00	2017-05-17 01:34:25.569+00	8	\N	18	t	t	t	t	8
10	FFGKWing	K-Wing Expansion Pack 	1995	Fantasy Flight Games K-Wing	none	Fantasy Flight Games, K-Wing, Star Wars	Minature	100	showit	2017-05-16 17:52:41.718+00	2017-05-17 01:34:44.531+00	8	41	18	t	t	t	t	3
34	FFGTiePunisherExpansionPack	Tie Punisher Expansion Pack	1995	Fantasy Flight Games Tie Punisher Expansion Pack 	\N	Fantasy Flight Games, Tie Punisher, Star Wars	Minature 	100	showit	2017-05-17 01:37:30.296+00	2017-05-17 01:37:30.296+00	8	\N	18	t	t	t	t	4
35	FFGKihraxzFighterExpansionPack	Kihraxz Fighter Expansion Pack 	1495	Fantasy Flight Games Kihraxz Fighter Expansion Pack 	\N	Fantasy Flight Games, Kihraxz Fighter, Star Wars	Minature 	100	showit	2017-05-17 01:40:15.358+00	2017-05-17 01:40:15.358+00	8	\N	18	t	t	t	t	4
36	FFGT70XwingExpansionPack	T-70 X-Wing Expansion Pack 	1495	Fantasy Flight Games T-70 X-Wing Expansion Pack 	\N	Fantasy Flight Games, T-70 X-Wing, Star Wars	Minature 	100	showit	2017-05-17 01:43:28.782+00	2017-05-17 01:43:28.782+00	8	\N	18	t	t	t	t	4
38	FFGGhostExpansionPack	Ghost Expansion Pack	4995	Fantasy Flight Games Ghost Expansion Pack	\N	Fantasy Flight Games, Ghost, Star Wars	Minature 	100	showit	2017-05-17 01:49:44.639+00	2017-05-17 01:49:44.639+00	8	\N	18	t	t	t	t	8
39	FFGMistHunterExpansionPack	Mist Hunter Expansion Pack 	1995	Fantasy Flight Games Mist Hunter Expansion Pack 	\N	Fantasy Flight Games, Mist Hunter, Star Wars	Minature 	100	showit	2017-05-17 01:52:22.747+00	2017-05-17 01:52:22.747+00	8	\N	18	t	t	t	t	4
40	FFGPunishingOneExpansionPack	Punishing One Expansion Pack 	2995	Fantasy Flight Games Punishing One Expansion Pack 	\N	Fantasy Flight Games, Punishing One, Star Wars	Minature 	100	showit	2017-05-17 01:54:53.119+00	2017-05-17 01:54:53.119+00	8	\N	18	t	t	t	t	8
41	FFGARC170ExpansionPack	ARC-170 Expansion Pack	1995	Fantasy Flight Games ARC-170 Expansion Pack	\N	Fantasy Flight Games, ARC-170, Star Wars	Minature 	100	showit	2017-05-17 01:58:06.339+00	2017-05-17 01:58:06.339+00	8	\N	18	t	t	t	t	4
42	FFGSpecialForcesTieExpansioPack	Special Forces Tie Expansion Pack 	1495	Fantasy Flight Games Special Forces Tie Expansion Pack 	\N	Fantasy Flight Games, Special Forces Tie, Star Wars	Minature 	100	showit	2017-05-17 02:31:27.078+00	2017-05-17 02:31:27.078+00	8	\N	18	t	t	t	t	4
43	FFGProtectorateStarfighterExpansionPack	Protectorate Starfighter Expansion Pack	1495	Fantasy Flight Games Protectorate Starfighter Expansion Pack 	\N	Fantasy Flight Games, Protectorate Starfighter, Star Wars	Minature 	100	showit	2017-05-17 02:34:42.33+00	2017-05-17 02:34:42.33+00	8	\N	18	t	t	t	t	4
44	FFGShadowCasterExpansionPack	Shadow Caster Expansion Pack	3995	Fantasy Flight Games Shadow Caster Expansion Pack 	\N	Fantasy Flight Games, Shadow Caster, Star Wars	Minature 	100	showit	2017-05-17 02:37:17.204+00	2017-05-17 02:37:17.204+00	8	\N	18	t	t	t	t	8
45	FFGQuadjumperExpansionPack	Quadjumper Expansion Pack 	1495	Fantasy Flight Games Quadjumper Expansion Pack	\N	Fantasy Flight Games, Quadjumper, Star Wars	Minature 	100	showit	2017-05-17 02:40:50.01+00	2017-05-17 02:40:50.01+00	8	\N	18	t	t	t	t	4
46	FFGSabinesTieFighterExpansionPack	Sabine's Tie Fighter Expansion Pack 	1495	Fantasy Flight Games Sabine's Tie Fighter Expansion Pack	\N	Fantasy Flight Games, Sabine's Tie Fighter Expansion Pack	Minature 	100	showit	2017-05-17 02:43:41.63+00	2017-05-17 02:43:41.63+00	8	\N	18	t	t	t	t	4
47	FFGUpsilonClassShuttleExpansionPack	Upsilon-class Shuttle Expansion Pack 	3995	Fantasy Flight Games Upsilon-Class Shuttle Expansion Pack 	\N	Fantasy Flight Games, Upsilon-class Shuttle, Star Wars	Minature 	100	showit	2017-05-17 02:47:11.015+00	2017-05-17 02:47:11.015+00	8	\N	18	t	t	t	t	8
48	FFGUwingExpansionPack	U-Wing Expansion Pack 	2995	Fantasy Flight Games U-wing Expansion Pack 	\N	Fantasy Flight Games, U-wing, Star Wars	Minature 	100	showit	2017-05-17 02:49:35.635+00	2017-05-17 02:49:35.635+00	8	\N	18	t	t	t	t	8
49	FFGTieStrikerExpansionPack	Tie Striker Expansion Pack 	1495	Fantasy Flight Games Tie Striker Expansion Pack 	\N	Fantasy Flight Games, Tie Striker, Star Wars	Minature 	100	showit	2017-05-17 02:51:56.15+00	2017-05-17 02:51:56.15+00	8	\N	18	t	t	t	t	4
50	FFGRebelTransportExpansionPack	Rebel Transport Expansion Pack	5995	Fantasy Flight Games Rebel Transport Expansion Pack 	\N	Fantasy Flight Games, Rebel Transport, Star Wars	Minature 	100	showit	2017-05-17 02:55:37.693+00	2017-05-17 02:55:37.693+00	8	\N	18	t	t	t	t	10
51	FFGTantiveIVExpansionPack	Tantive IV Expansion Pack 	8995	Fantasy Flight Games Tantive IV Expansion Pack 	\N	Fantasy Flight Games, Tantive IV, Star Wars	Minature 	100	showit	2017-05-17 02:58:36.048+00	2017-05-17 02:58:36.048+00	8	\N	18	t	t	t	t	15
52	FFGImperialAssaultCarrier	Imperial Assault Carrier	6995	Fantasy Flight Games Imperial Assault Carrier	\N	Fantasy Flight Games, Imperial Assault Carrier, Star Wars	Minature 	100	showit	2017-05-17 03:01:52.541+00	2017-05-17 03:01:52.541+00	8	\N	18	t	t	t	t	15
53	FFGImperialRaiderExpansionPack	Imperial Raider Expansion Pack 	9995	Fantasy Flight Games Imperial Raider Expansion Pack 	\N	Fantasy Flight Games, Imperial Raider, Star Wars	Minature 	100	showit	2017-05-17 03:04:17.172+00	2017-05-17 03:04:17.172+00	8	\N	18	t	t	t	t	15
54	FFGSWArmada	Star Wars: Armada	9995	Fantasy Flight Games Star Wars: Armada	\N	Fantasy Flight Games, Armada, Star Wars	Minature 	100	showit	2017-05-17 04:45:14.607+00	2017-05-17 04:45:14.607+00	8	\N	12	t	t	t	t	15
55	FFGVictoryClassStarDestroyerExpansionPack	Victory-class Star Destroyer Expansion Pack 	3995	Fantasy Flight Games Victory-class Star Destroyer Expansion Pack 	\N	Fantasy Flight Games, Victory-class Star Destroyer, Star Wars	Minature 	100	showit	2017-05-17 04:50:04.919+00	2017-05-17 04:50:04.919+00	8	\N	12	t	t	t	t	8
56	FFGCR90ExpansionPack	CR90 Corellian Corvette Expansion Pack 	1995	Fantasy Flight Games CR90 Corellian Corvette Expansion Pack 	\N	Fantasy Flight Games, CR90 Corellian Corvette, Star Wars	Minature 	100	showit	2017-05-17 04:55:18.789+00	2017-05-17 04:55:18.789+00	8	\N	12	t	t	t	t	4
57	FFGNebulonBFrigateExpansionPack	Nebulon-B Frigate Expansion Pack 	1995	Fantasy Flight Games Nebulon-B Frigate Expansion Pack 	\N	Fantasy Flight Games, Nebulon-B Frigate, Star Wars	Minature 	100	showit	2017-05-17 05:00:37.798+00	2017-05-17 05:00:37.798+00	8	\N	12	t	t	t	t	4
58	FFGAssaultFrigateMarkIIExpansionPack	Assault Frigate Mark II Expansion Pack 	3995	Fantasy Flight Games Assault Frigate Mark II Expansion Pack 	\N	Fantasy Flight Games, Assault Frigate Mark II, Star Wars	Minature 	100	showit	2017-05-17 05:06:47.203+00	2017-05-17 05:06:47.203+00	8	\N	12	t	t	t	t	8
59	FFGGladiatorClassStarDestroyerExpansionPack	Gladiator-class Star Destroyer Expansion Pack 	2995	Fantasy Flight Games Gladiator-class Star Destroyer Expansion Pack 	\N	Fantasy Flight Games, Gladiator-class Star Destroyer, Star Wars	Minature 	100	showit	2017-05-17 05:11:07.312+00	2017-05-17 05:11:07.312+00	8	\N	12	t	t	t	t	8
60	FFGRebelFighterSquadronsExpansionPack	Rebel Fighter Squadrons Expansion Pack 	1995	Fantasy Flight Games Rebel Fighter Squadrons Expansion Pack 	\N	Fantasy Flight Games, Rebel Fighter Squadrons, Star Wars	Minature 	100	showit	2017-05-17 05:15:06+00	2017-05-17 05:15:06+00	8	\N	12	t	t	t	t	4
61	FFGImperialFighterSquadronExpansionPack	Imperial Fighter Squadrons Expansion Pack	1995	Fantasy Flight Games Imperial Fighter Squadrons Expansion Pack 	\N	Fantasy Flight Games, Imperial Fighter Squadrons, Star Wars	Minature 	100	showit	2017-05-17 05:19:35.378+00	2017-05-17 05:19:35.378+00	8	\N	12	t	t	t	t	4
62	FFGInterdictorExpansionPack	Interdictor Expansion Pack	3995	Fantasy Flight Games Interdictor Expansion Pack 	\N	Fantasy Flight Games, Interdictor, Star Wars	Minature 	100	showit	2017-05-17 05:24:00.246+00	2017-05-17 05:24:00.246+00	8	\N	12	t	t	t	t	8
63	FFGLibertyExpansionPack	Liberty Expansion Pack	3995	Fantasy Flight Games Liberty Expansion Pack 	\N	Fantasy Flight Games, Liberty, Star Wars	Minature 	100	showit	2017-05-17 05:27:48.371+00	2017-05-17 05:27:48.371+00	8	\N	12	t	t	t	t	8
64	FFGImperialAssaultCarriersExpansionPack	Imperial Assault Carriers Expansion Pack	1995	Fantasy Flight Games Imperial Assault Carriers Expansion Pack 	\N	Fantasy Flight Games, Imperial Assault Carriers, Star Wars 	Minature 	100	showit	2017-05-17 05:32:06.609+00	2017-05-17 05:32:06.609+00	8	\N	12	t	t	t	t	4
65	FFGRebelTransportsExpansionPack	Rebel Transports Expansion Pack 	1995	Fantasy Flight Games Rebel Transports Expansion Pack 	\N	Fantasy Flight Games, Rebel Transports, Star Wars	Minature 	100	showit	2017-05-17 05:34:55.949+00	2017-05-17 05:34:55.949+00	8	\N	12	t	t	t	t	4
66	FFGPhoenixHomeExpansionPack	Phoenix Home Expansion Pack 	2995	Fantasy Flight Games Phoenix Home Expansion Pack 	\N	Fantasy Flight Games, Phoenix Home, Star Wars	Minature	100	showit	2017-05-17 05:39:47.956+00	2017-05-17 05:39:47.956+00	8	\N	12	t	t	t	t	8
67	FFGImperialLightCruiserExpansionPack	Imperial Light Cruiser Expansion Pack 	1995	Fantasy Flight Games Imperial Light Cruiser Expansion Pack 	\N	Fantasy Flight Games, Imperial Light Cruiser, Star Wars	Minature 	100	showit	2017-05-17 05:44:00.951+00	2017-05-17 05:44:00.951+00	8	\N	12	t	t	t	t	4
99	GWSpaceMarineHeroes	Space Marine Heroes	5000	Games Workshop Space Marine Heroes	\N	Games Workshop, Space Marine Heroes, 40k	Minature 	100	showit	2017-05-17 19:48:59.098+00	2017-05-17 19:48:59.098+00	10	\N	22	t	t	t	t	8
68	FFGRebelFighterSquadronsIIExpansionPack	Rebel Fighter Squadrons II Expansion Pack 	1995	Fantasy Flight Games Rebel Fighter Squadrons II Expansion Pack 	\N	Fantasy Flight Games, Rebel Fighter Squadrons II, Star Wars	Minature 	100	showit	2017-05-17 05:47:44.291+00	2017-05-17 05:47:44.291+00	8	\N	12	t	t	t	t	4
69	FFGImperialFighterSquadronsIIExpansionPack	Imperial Fighter Squadrons II Expansion Pack 	1995	Fantasy Flight Games Imperial Fighter Squadrons II Expansion Pack 	\N	Fantasy Flight Games, Imperial Fighter Squadrons II, Star Wars	Minature 	100	showit	2017-05-17 05:51:25.304+00	2017-05-17 05:51:25.304+00	8	\N	12	t	t	t	t	4
70	FFGImperialclassStarDestroyerExpansionPack	Imperial-class Star Destroyer Expansion Pack 	4995	Fantasy Flight Games Imperial-class Star Destroyer Expansion Pack 	\N	Fantasy Flight Games, Imperial-class Star Destroyer, Star Wars	Minature 	100	showit	2017-05-17 05:55:55.248+00	2017-05-17 05:55:55.248+00	8	\N	12	t	t	t	t	8
71	FFGMC30cFrigateExpansionPack	MC30c Frigate Expansion Pack 	2995	Fantasy Flight Games MC30c Frigate Expansion Pack 	\N	Fantasy Flight Games, MC30c Frigate, Star Wars	Minature 	100	showit	2017-05-17 05:59:24.136+00	2017-05-17 05:59:24.136+00	8	\N	12	t	t	t	t	7
72	FFGHomeOneExpansionPack	Home One Expansion Pack	3995	Fantasy Flight Games Home One Expansion Pack 	\N	Fantasy Flight Games, Home One, Star Wars 	Minature 	100	showit	2017-05-17 06:01:42.312+00	2017-05-17 06:01:42.312+00	8	\N	12	t	t	t	t	8
73	FFGRoguesandVillainsExpansionPack	Rogues and Villains Expansion Pack	1995	Fantasy Flight Games Rogues and Villains Expansion Pack 	\N	Fantasy Flight Games, Rogues and Villains, Star Wars	Minature 	100	showit	2017-05-17 06:04:29.548+00	2017-05-17 06:04:29.548+00	8	\N	12	t	t	t	t	4
74	FFGImperialRaiderExpansionPack	Imperial Raider Expansion Pack 	1995	Fantasy Flight Games Imperial Raider Expansion Pack 	\N	Fantasy Flight Games, Imperial Raider, Star Wars	Minature 	100	showit	2017-05-17 06:06:52.212+00	2017-05-17 06:06:52.212+00	8	\N	12	t	t	t	t	4
75	GWStartCollectingSpaceMarines	Start Collecting: Space Marines	8500	Games Workshop Start Collecting: Space Marines	\N	Games Workshop, Start Collecting: Space Marines, 40k	Minature 	100	showit	2017-05-17 16:35:24.017+00	2017-05-17 16:35:24.017+00	10	\N	22	t	t	t	t	8
76	GWTriumvirateofthePrimarch	Triumvirate of the Primarch	9000	Games Workshop Triumvirate of the Primarch	\N	Games Workshop, Triumvirate of the Primarch, 40k	Minature 	100	showit	2017-05-17 16:38:39.331+00	2017-05-17 16:38:39.331+00	10	\N	22	t	t	t	t	8
77	GWStormhawkInterceptor	Stormhawk Interceptor 	5500	Games Workshop Stormhawk Interceptor 	\N	Games Workshop, Stormhawk Interceptor, 40k	Minature 	100	showit	2017-05-17 16:41:54.738+00	2017-05-17 16:41:54.738+00	10	\N	22	t	t	t	t	10
78	GWStormtalonGunship	Stormtalon Gunship	5500	Games Workshop Stormtalon Gunship	\N	Games Workshop, Stormtalon Gunship, 40k	Minature 	100	showit	2017-05-17 16:44:53.389+00	2017-05-17 16:44:53.389+00	10	\N	22	t	t	t	t	10
79	GWSpaceMarineTacticalSquad	Space Marine Tactical Squad	4000	Games Workshop Space Marine Tactical Squad	\N	Games Workshop, Space Marine Tactical Squad, 40k	Minature 	100	showit	2017-05-17 16:49:24.384+00	2017-05-17 16:49:24.384+00	10	\N	22	t	t	t	t	8
80	GWSpaceMarineAssaultSquad	Space Marine Assault Squad	4100	Games Workshop Space Marine Assault Squad	\N	Games Workshop, Space Marine Assault Squad, 40k	Minature 	100	showit	2017-05-17 16:52:19.852+00	2017-05-17 16:52:19.852+00	10	\N	22	t	t	t	t	8
81	GWTerminatorSquad	Terminator Squad	5000	Games Workshop Terminator Squad	\N	Games Workshop, Terminator Squad, 40k	Minature 	100	showit	2017-05-17 16:55:50.017+00	2017-05-17 16:55:50.017+00	10	\N	22	t	t	t	t	8
82	GWStormravenGunship	Stormraven Gunship	8250	Games Workshop Stormraven Gunship	\N	Games Workshop, Stormraven Gunship, 40k	Minature 	100	showit	2017-05-17 16:59:07.937+00	2017-05-17 16:59:07.937+00	10	\N	22	t	t	t	t	10
83	GWDevastatorSquad	Devastator Squad	4600	Games Workshop Devastator Squad	\N	Games Workshop, Devastator Squad	Minature 	100	showit	2017-05-17 17:05:14.637+00	2017-05-17 17:05:14.637+00	10	\N	22	t	t	t	t	8
84	GWSternguardVeteranSquad	Sternguard Veteran Squad 	5000	Games Workshop Sternguard Veteran Squad	\N	Games Workshop, Sternguard Veteran Squad 	Minature 	100	showit	2017-05-17 17:08:33.52+00	2017-05-17 17:08:33.52+00	10	\N	22	t	t	t	t	8
85	GWVanguardVeteranSquad	Vanguard Veteran Squad 	4000	Games Workshop Vanguard Veteran Squad	\N	Games Workshop, Vanguard Veteran Squad, 40k	Minature 	100	showit	2017-05-17 17:10:48.728+00	2017-05-17 17:10:48.728+00	10	\N	22	t	t	t	t	8
86	GWDropPod	Drop Pod	3725	Games Workshop Drop Pod	\N	Games Workshop, Drop Pod, 40k	Minature 	100	showit	2017-05-17 17:14:47.188+00	2017-05-17 17:14:47.188+00	10	\N	22	t	t	t	t	8
12	GWLandRaider	Space Marine Land Raider	7425	Games Workshop Space Marine Land Raider	none	Games Workshop, Space Marine Land Raider, 40k	minature	100	showit	2017-05-16 17:59:59.864+00	2017-05-17 17:17:09.663+00	10	\N	22	t	t	t	t	10
87	GWSpaceMarineRhino	Space Marine Rhino	3725	Games Workshop Space Marine Rhino	\N	Games Workshop, Space Marine Rhino, 40k	Minature 	100	showit	2017-05-17 19:04:52.95+00	2017-05-17 19:04:52.95+00	10	\N	22	t	t	t	t	8
88	GWCenturionDevastatorSquad	Centurion Devastator Squad 	7800	Games Workshop Centurion Devastator Squad 	\N	Games Workshop, Centurion Devastator Squad, 40k	Minature 	100	showit	2017-05-17 19:08:02.143+00	2017-05-17 19:08:02.143+00	10	\N	22	t	t	t	t	8
89	GWCenturionAssaultSquad	Centurion Assault Squad 	7800	Games Workshop Centurion Assault Squad 	\N	Games Workshop, Centurion Assault Squad, 40k	Minature 	100	showit	2017-05-17 19:09:53.585+00	2017-05-17 19:09:53.585+00	10	\N	22	t	t	t	t	8
90	GWLandRaiderRedeemer	Land Raider Redeemer	7425	Games Workshop Land Raider Redeemer	\N	Games Workshop, Land Raider Redeemer, 40k	Minature 	100	showit	2017-05-17 19:13:15.918+00	2017-05-17 19:13:15.918+00	10	\N	22	t	t	t	t	10
91	GWLandRaiderCrusader	Land Raider Crusader	7425	Games Workshop Land Raider Crusader	\N	Games Workshop, Land Raider Crusader, 40k	Minature 	100	showit	2017-05-17 19:16:00.815+00	2017-05-17 19:16:00.815+00	10	\N	22	t	t	t	t	10
92	GWSpaceMarineHunter	Space Marine Hunter	6500	Games Workshop Space Marine Hunter	\N	Games Workshop, Space Marine Hunter, 40k	Minature 	100	showit	2017-05-17 19:18:15.28+00	2017-05-17 19:18:15.28+00	10	\N	22	t	t	t	t	10
93	GWSpaceMarineStalker	Space Marine Stalker	6500	Games Workshop Space Marine Stalker	\N	Games Workshop, Space Marine Stalker, 40k	Minature 	100	showit	2017-05-17 19:20:19.889+00	2017-05-17 19:20:19.889+00	10	\N	22	t	t	t	t	10
94	GWTartarosTerminators	Tartaros Terminators 	6000	Games Workshop Tartaros Terminators 	\N	Games Workshop, Tartaros Terminators, 40k	Minature 	100	showit	2017-05-17 19:23:23.095+00	2017-05-17 19:23:23.095+00	10	\N	22	t	t	t	t	8
95	GWSpaceMarineTerminatorCommand	Space Marine Terminator Command	6000	Games Workshop Space Marine Terminator Command	\N	Games Workshop, Space Marine Terminator Command, 40k	Minature 	100	showit	2017-05-17 19:27:28.185+00	2017-05-17 19:27:28.185+00	10	\N	22	t	t	t	t	8
96	GWSpaceMarineVindicator	Space Marine Vindicator 	5775	Games Workshop Space Marine Vindicator 	\N	Games Workshop, Space Marine Vindicator, 40k	Minature 	100	showit	2017-05-17 19:30:22.384+00	2017-05-17 19:30:22.384+00	10	\N	22	t	t	t	t	10
97	GWPredator	Predator 	5775	Games Workshop Predator 	\N	Games Workshop, Predator, 40k	Minature 	100	showit	2017-05-17 19:32:14.289+00	2017-05-17 19:32:14.289+00	10	\N	22	t	t	t	t	10
98	GWSpaceMarinesSkyhammerTacticalSquad	Space Marines Skyhammer Tactical Squad	5500	Games Workshop Space Marines Skyhammer Tactical Squad 	\N	Games Workshop, Space Marines Skyhammer Tactical Squad, 40k	Minature 	100	showit	2017-05-17 19:46:10.152+00	2017-05-17 19:46:10.152+00	10	\N	22	t	t	t	t	10
100	GWMarkIIISpaceMarines	Mark III Space Marines	5000	Games Workshop Mark III Space Marines	\N	Games Workshop, Mark III Space Marines, 40k	Minature 	100	showit	2017-05-17 19:51:47.544+00	2017-05-17 19:51:47.544+00	10	\N	22	t	t	t	t	8
101	GWSpaceMarineTerminatorCloseCombatSquad	Space Marine Terminator Close Combat Squad	5000	Games Workshop Space Marine Terminator Close Combat Squad 	\N	Games Workshop, Space Marine Terminator Close Combat Squad, 40k	Minature 	100	showit	2017-05-17 19:56:27.144+00	2017-05-17 19:56:27.144+00	10	\N	22	t	t	t	t	8
102	GWSpaceMarineCompanyCommand	Space Marine Company Command 	5000	Games Workshop Space Marine Company Command 	\N	Games Workshop, Space Marine Company Command, 40k	Min	100	showit	2017-05-17 19:59:51.801+00	2017-05-17 19:59:51.801+00	10	\N	22	t	t	t	t	8
103	GWSpaceMarineDreadnought	Space Marine Dreadnought	4625	Games Workshop, Space Marine Dreadnought	\N	Games Workshop, Space Marine Dreadnought	Minature 	100	showit	2017-05-17 20:02:46.123+00	2017-05-17 20:03:15.276+00	10	\N	22	t	t	t	t	8
104	GWIroncladDreadnought	Ironclad Dreadnought 	4625	Games Workshop Ironclad Dreadnought 	\N	Games Workshop, Ironclad Dreadnought, 40k	Minature 	100	showit	2017-05-17 20:05:41.39+00	2017-05-17 20:05:41.39+00	10	\N	22	t	t	t	t	8
105	GWSpaceMarineVenerableDreadnought	Space Marine Venerable Dreadnought 	4625	Games Workshop Space Marine Venerable Dreadnought 	\N	Games Workshop, Space Marine Venerable Dreadnought, 40k	Minature 	100	showit	2017-05-17 20:10:01.873+00	2017-05-17 20:10:01.873+00	10	\N	22	t	t	t	t	8
106	GWRazorback	Razorback	4125	Games Workshop Razorback	\N	Games Workshop, Razorback, 40k	Minature 	100	showit	2017-05-17 20:13:22.032+00	2017-05-17 20:13:22.032+00	10	\N	22	t	t	t	t	8
107	GWScoutBikeSquad	Scout Bike Squad	4000	Games Workshop Scout Bike Squad 	\N	Games Workshop, Scout Bike Squad, 40k	Minature 	100	showit	2017-05-17 20:17:09.265+00	2017-05-17 20:17:09.265+00	10	\N	22	t	t	t	t	8
108	GWSpaceMarineBikeSquad	Space Marine Bike Squad 	4000	Games Workshop Space Marine Bike Squad 	\N	Games Workshop, Space Marine Bike Squad, 40k	Minature 	100	showit	2017-05-17 20:19:44.784+00	2017-05-17 20:19:44.784+00	10	\N	22	t	t	t	t	8
109	GWSpaceMarineCommandSquad	Space Marine Command Squad 	3500	Games Workshop Space Marine Command Squad 	\N	Games Workshop, Space Marine Command Squad, 40k	Minature 	100	showit	2017-05-17 20:23:29.336+00	2017-05-17 20:23:29.336+00	10	\N	22	t	t	t	t	8
110	GWSpaceMarineLibrarianinTerminatorArmour	Space Marine Librarian in Terminator Armour	3100	Games Workshop Space Marine Librarian in Terminator Armour	\N	Games Workshop, Space Marine Librarian in Terminator Armour, 40k	Min	100	showit	2017-05-17 20:28:30.552+00	2017-05-17 20:28:30.552+00	10	\N	22	t	t	t	t	6
111	GWSpaceMarineLibrarian	Space Marine Librarian 	3000	Games Workshop Space Marine Librarian 	\N	Games Workshop, Space Marine Librarian, 40k	Minature 	100	showit	2017-05-17 20:30:48.886+00	2017-05-17 20:30:48.886+00	10	\N	22	t	t	t	t	6
112	GWLandSpeederStorm	Land Speeder Storm	3000	Games Workshop Land Speeder Storm	\N	Games Workshop, Land Speeder Storm, 40k	Minature 	100	showit	2017-05-17 20:34:06.861+00	2017-05-17 20:34:06.861+00	10	\N	22	t	t	t	t	6
113	GWLandSpeeder	Land Speeder	3000	Games Workshop Land Speeder 	\N	Games Workshop, Land Speeder, 40k	Minature 	100	showit	2017-05-17 20:36:14.939+00	2017-05-17 20:36:14.939+00	10	\N	22	t	t	t	t	6
114	GWSpaceMarineCaptain	Space Marine Captain 	3000	Games Workshop Space Marine Captain 	\N	Games Workshop, Space Marine Captain, 40k	Minature 	100	showit	2017-05-17 20:39:37.512+00	2017-05-17 20:39:37.512+00	10	\N	22	t	t	t	t	5
115	GWSpaceMarineAttackBike	Space Marine Attack Bike	2725	Games Workshop Space Marine Attack Bike 	\N	Games Workshop, Space Marine Attack Bike, 40k	Minature 	100	showit	2017-05-17 21:09:46.611+00	2017-05-17 21:09:46.611+00	10	\N	22	t	t	t	t	6
116	GWSpaceMarineScouts	Space Marine Scouts	2500	Games Workshop Space Marine Scouts	\N	Games Workshop, Space Marine Scouts 	Minature 	100	showit	2017-05-17 21:13:06.913+00	2017-05-17 21:13:06.913+00	10	\N	22	t	t	t	t	5
117	GWSpaceMarineScoutswithSniperRifles	Space Marine Scouts with Sniper Rifles	2500	Games Workshop Space Marine Scouts with Sniper Rifles	\N	Games Workshop, Space Marine Scouts with Sniper Rifles, 40k	Minature 	100	showit	2017-05-17 21:16:47.765+00	2017-05-17 21:16:47.765+00	10	\N	22	t	t	t	t	5
118	GWSpaceMarineCommander	Space Marine Commander	2225	Games Workshop Space Marine Commander 	\N	Games Workshop, Space Marine Commander, 40k	Minature 	100	showit	2017-05-17 21:18:58.891+00	2017-05-17 21:18:58.891+00	10	\N	22	t	t	t	t	5
119	GWStartCollectingBloodAngels	Start Collecting: Blood Angels	8500	Games Workshop Start Collecting: Blood Angels	\N	Games Workshop, Start Collecting: Blood Angels	Minature 	100	showit	2017-05-17 21:26:31.979+00	2017-05-17 21:26:31.979+00	10	\N	22	t	t	t	t	8
120	GWBloodAngelsTacticalSquad	Blood Angels Tactical Squad	4300	Games Workshop Blood Angels Tactical Squad	\N	Games Workshop, Blood Angels Tactical Squad, 40k	Minature 	100	showit	2017-05-17 21:29:43.033+00	2017-05-17 21:29:43.033+00	10	\N	22	t	t	t	t	6
121	GWBloodAngelsTerminatorAssaultSquad	Blood Angels Terminator Assault Squad	6000	Games Workshop Blood Angels Terminator Assault Squad 	\N	Games Workshop, Blood Angels Terminator Assault Squad, 40k	Minature 	100	showit	2017-05-17 21:33:58.151+00	2017-05-17 21:33:58.151+00	10	\N	22	t	t	t	t	6
122	GWBaalPredator	Baal Predator 	5775	Games Workshop Baal Predator 	\N	Games Workshop, Baal Predator, 40k	Minature 	100	showit	2017-05-17 23:53:25.765+00	2017-05-17 23:53:25.765+00	10	\N	22	t	t	t	t	8
123	GWBloodAngelsFuriosoDreadnaught	Blood Angels Furioso Dreadnought 	4625	Games Workshop Blood Angels Furioso Dreadnought 	\N	Games Workshop, Blood Angels Furioso Dreadnought, 40k	Minature 	100	showit	2017-05-17 23:57:03.049+00	2017-05-17 23:57:03.049+00	10	\N	22	t	t	t	t	8
124	GWSanguinaryPriest	Sanguinary Priest	3000	Games Workshop Sanguinary Priest	\N	Games Workshop, Sanguinary Priest, 40k	Minature 	100	showit	2017-05-18 00:01:30.259+00	2017-05-18 00:01:30.259+00	10	\N	22	t	t	t	t	6
125	GWBloodAngelsSternguardVeteranSquad	Blood Angels Sternguard Veteran Squad	5500	Games Workshop Blood Angels Sternguard Veteran Squad 	\N	Games Workshop, Blood Angels Sternguard Veteran Squad, 40k	Minature 	100	showit	2017-05-18 00:04:40.41+00	2017-05-18 00:04:40.41+00	10	\N	22	t	t	t	t	6
126	GWBloodAngelsLibrarianDreadnought	Blood Angels Librarian Dreadnought 	4625	Games Workshop Blood Angels Librarian Dreadnought 	\N	Games Workshop, Blood Angels Librarian Dreadnought, 40k	Minature 	100	showit	2017-05-18 00:08:59.253+00	2017-05-18 00:08:59.253+00	10	\N	22	t	t	t	t	8
127	GWBloodAngelsDeathCompanyDreadnought	Blood Angels Death Company Dreadnought 	4625	Games Workshop Blood Angels Death Company Dreadnought 	\N	Games Workshop, Blood Angels Death Company Dreadnought, 40k	Minature 	100	showit	2017-05-18 00:12:39.526+00	2017-05-18 00:12:39.526+00	10	\N	22	t	t	t	t	6
128	GWBloodAngelsVanguardVeteranSquad	Blood Angels Vanguard Veteran Squad	4500	Games Workshop Blood Angels Vanguard Veteran Squad 	\N	Games Workshop, Blood Angels Vanguard Veteran Squad, 40k	Minature 	100	showit	2017-05-18 00:16:40.329+00	2017-05-18 00:16:40.329+00	10	\N	22	t	t	t	t	6
129	GWBloodAngelsCommandSquad	Blood Angels Command Squad	4500	Games Workshop Blood Angels Command Squad	\N	Games Workshop, Blood Angels Command Squad, 40k	Minature 	100	showit	2017-05-18 00:20:27.816+00	2017-05-18 00:20:27.816+00	10	\N	22	t	t	t	t	6
130	GWBloodAngelsAssaultSquad	Blood Angels Assault Squad 	4500	Games Workshop Blood Angels Assault Squad	\N	Games Workshop Blood Angels Assault Squad, 40k	Min	100	showit	2017-05-18 00:23:15.589+00	2017-05-18 00:23:15.589+00	10	\N	22	t	t	t	t	6
131	GWSanguinaryGuard	Sanguinary Guard	3300	Games Workshop Sanguinary Guard 	\N	Games Workshop, Sanguinary Guard, 40k	Minature 	100	showit	2017-05-18 00:25:50.86+00	2017-05-18 00:25:50.86+00	10	\N	22	t	t	t	t	6
132	GWBloodAngelsChaplainwithJumpPack	Blood Angels Chaplain with Jump Pack	3300	Games Workshop Blood Angels Chaplain with Jump Pack	\N	Games Workshop, Blood Angels Chaplain with Jump Pack, 40k	Minature 	100	showit	2017-05-18 00:28:59.578+00	2017-05-18 00:28:59.578+00	10	\N	22	t	t	t	t	6
133	GWDeathCompany	Death Company	3300	Games Workshop Death Company 	\N	Games Workshop, Death Company, 40k	Minature 	100	showit	2017-05-18 00:30:55.646+00	2017-05-18 00:30:55.646+00	10	\N	22	t	t	t	t	6
134	GWBloodAngelsCaptaininTerminatorArmour	Blood Angels Captain in Terminator Armour 	3300	Games Workshop Blood Angels Captain in Terminator Armour 	\N	Games Workshop, Blood Angels Captain in Terminator Armour, 40k	Minature 	100	showit	2017-05-18 00:34:16.424+00	2017-05-18 00:34:16.424+00	10	\N	22	t	t	t	t	6
135	GWDeathwingKnights	Deathwing Knights	6000	Games Workshop Deathwing Knights	\N	Games Workshop, Deathwing Knights, 40k	Minature 	100	showit	2017-05-18 00:42:10.996+00	2017-05-18 00:42:10.996+00	10	\N	22	t	t	t	t	6
136	GWRavenwingDarkTalon	Ravenwing Dark Talon	7500	Games Workshop Ravenwing Dark Talon 	\N	Games Workshop, Ravenwing Dark Talon, 40k	Minature 	100	showit	2017-05-18 00:45:30.316+00	2017-05-18 00:45:30.316+00	10	\N	22	t	t	t	t	8
137	GWRavenwingBlackKnights	Ravenwing Black Knights	5000	Games Workshop Ravenwing Black Knights	\N	Games Workshop, Ravenwing Black Knights, 40k	Minature 	100	showit	2017-05-18 02:44:33.752+00	2017-05-18 02:44:33.752+00	10	\N	22	t	t	t	t	6
138	GWRavenwingDarkshroud	Ravenwing Darkshroud	6500	Games Workshop Ravenwing Darkshroud	\N	Games Workshop, Ravenwing Darkshroud 	Minature 	100	showit	2017-05-18 02:48:02.526+00	2017-05-18 02:48:02.526+00	10	\N	22	t	t	t	t	8
139	GWBelial	Belial	2225	Games Workshop Belial	\N	Games Workshop, Belial, 40k	Minature 	100	showit	2017-05-18 02:51:37.139+00	2017-05-18 02:51:37.139+00	10	\N	22	t	t	t	t	4
140	GWNephilimJetfighter	Nephilim jetfighter	7500	Games Workshop Nephilim jetfighter	\N	Games Workshop, Nephilim jetfighter, 40k	Minature 	100	showit	2017-05-18 02:55:31.014+00	2017-05-18 02:55:31.014+00	10	\N	22	t	t	t	t	8
141	GWLandSpeederVengeance	Land Speeder Vengeance 	6500	Games Workshop Land Speeder Vengeance 	\N	Games Workshop, Land Speeder Vengeance, 40k	Minature 	100	showit	2017-05-18 02:58:28.391+00	2017-05-18 02:58:28.391+00	10	\N	22	t	t	t	t	8
142	GWDeathwingCommandSquad	Deathwing Command Squad 	6000	Games Workshop Deathwing Command Squad 	\N	Games Workshop, Deathwing Command Squad, 40k	Minature 	100	showit	2017-05-18 03:01:43.434+00	2017-05-18 03:01:43.434+00	10	\N	22	t	t	t	t	6
143	GWDeathwingTerminatorSquad	Deathwing Terminator Squad 	6000	Games Workshop Deathwing Terminator Squad 	\N	Games Workshop, Deathwing Terminator Squad, 40k	Minature 	100	showit	2017-05-18 03:05:24.559+00	2017-05-18 03:05:24.559+00	10	\N	22	t	t	t	t	6
144	GWRavenwingCommandSquad	Ravenwing Command Squad 	5000	Games Workshop Ravenwing Command Squad 	\N	Games Workshop, Ravenwing Command Squad, 40k	Minature 	100	showit	2017-05-18 03:08:07.47+00	2017-05-18 03:08:07.47+00	10	\N	22	t	t	t	t	8
145	GWRavenwingBikeSquadron	Ravenwing Bike Squadron 	4125	Games Workshop Ravenwing Bike Squadron 	\N	Games Workshop, Ravenwing Bike Squadron, 40k	Minature 	100	showit	2017-05-18 03:12:08.74+00	2017-05-18 03:12:08.74+00	10	\N	22	t	t	t	t	8
146	GWDarkAngelsCompanyVeteransSquad	Dark Angels Company Veterans Squad	3300	Games Workshop Dark Angels Company Veterans Squad	\N	Dark Angels Company Veterans Squad	Minature 	100	showit	2017-05-18 03:16:13.148+00	2017-05-18 03:16:13.148+00	10	\N	22	t	t	t	t	6
147	GWFallen	Fallen	3300	Games Workshop Fallen	\N	Fallen, 40k	Minature 	100	showit	2017-05-18 03:18:17.598+00	2017-05-18 03:18:17.598+00	10	\N	22	t	t	t	t	6
148	GWDarkAngelsInterrogatorChaplin	Dark Angels Interrogator-Chaplain 	3000	Games Workshop Dark Angels Interrogator-Chaplain 	\N	Dark Angels Interrogator-Chaplain, 40k	Minature 	100	showit	2017-05-18 03:23:45.008+00	2017-05-18 03:23:45.008+00	10	\N	22	t	t	t	t	4
149	GWNemesis Dreadknight	Nemesis Dreadknight	5375	Games Workshop Nemesis Dreadknight 	\N	Nemesis Dreadknight, 40k	Minature 	100	showit	2017-05-18 19:36:54.268+00	2017-05-18 19:36:54.268+00	10	\N	22	t	t	t	t	5
150	GWGreyKnightsStrikeSquad	Grey Knights Strike Squad	6000	Games Workshop Grey Knights Strike Squad	\N	Grey Knights Strike Squad, 40k	Minature 	100	showit	2017-05-18 19:39:47.928+00	2017-05-18 19:39:47.928+00	10	\N	22	t	t	t	t	6
151	GWGreyKnightsPurifiers	Grey Knights Purifiers	3300	Games Workshop Grey Knights Purifiers 	\N	Grey Knights Purifiers	Minature 	100	showit	2017-05-18 19:42:57.18+00	2017-05-18 19:42:57.18+00	10	\N	22	t	t	t	t	6
152	GWGreyKnightsInterceptorSquad	Grey Knights Interceptor Squad 	3300	Games Workshop Grey Knights Interceptor Squad 	\N	Grey Knights Interceptor Squad 	Minature 	100	showit	2017-05-18 19:46:38.371+00	2017-05-18 19:46:38.371+00	10	\N	22	t	t	t	t	6
153	GWGreyKnightsPurgationSquad	Grey Knights Purgation Squad	3300	Games Workshop Grey Knights Purgation Squad 	\N	Grey Knights Purgation Squad 	Minature 	100	showit	2017-05-18 19:49:44.499+00	2017-05-18 19:49:44.499+00	10	\N	22	t	t	t	t	6
154	GWGreyKnightsTerminators	Grey Knights Terminators 	5000	Games Workshop Grey Knights Terminators 	\N	Grey Knights Terminators 	Minature 	100	showit	2017-05-18 19:53:30.478+00	2017-05-18 19:53:30.478+00	10	\N	22	t	t	t	t	6
155	GWGreyKnightsPaladins	Grey Knights Paladins 	5000	Games Workshop Grey Knights Paladins 	\N	Grey Knights Paladins 	Minature 	100	showit	2017-05-18 19:56:04.188+00	2017-05-18 19:56:04.188+00	10	\N	22	t	t	t	t	6
156	GWGreyKnightsStrikeSquad5	Grey Knights Strike Squad (5 models)	3300	Games Workshop Grey Knights Strike Squad (5 models)	\N	Grey Knights Strike Squad (5 models)	Minature 	100	showit	2017-05-18 19:59:52.233+00	2017-05-18 19:59:52.233+00	10	\N	22	t	t	t	t	6
157	GWBjorntheFellHanded	Bjorn the Fell-Handed	5400	Games Workshop Bjorn the Fell-Handed	\N	Bjorn the Fell-Handed	Minature 	100	showit	2017-05-18 20:06:03.068+00	2017-05-18 20:06:03.068+00	10	\N	22	t	t	t	t	6
158	GWLoganGrimnarOnStormrider	Logan Grimnar on Stormrider	5900	Games Workshop Logan Grimnar on Stormrider	\N	Logan Grimnar on Stormrider 	Minature 	100	showit	2017-05-18 21:20:07.615+00	2017-05-18 21:20:07.615+00	10	\N	22	t	t	t	t	8
159	GWStartCollectingSpaceWolves	Start Collecting: Space Wolves	8500	Games Workshop Start Collecting: Space Wolves	\N	Start Collecting: Space Wolves	Minature 	100	showit	2017-05-18 21:23:29.257+00	2017-05-18 21:23:29.257+00	10	\N	22	t	t	t	t	8
160	GWThunderwolfCavalry	Thunderwolf Cavalry 	5450	Games Workshop Thunderwolf Cavalry 	\N	Thunderwolf Cavalry 	Minature 	100	showit	2017-05-18 21:28:09.348+00	2017-05-18 21:28:43.534+00	10	\N	22	t	t	t	t	6
161	GWSpaceWolvesPack	Space Wolves Pack	3700	Games Workshop Space Wolves Pack	\N	Space Wolves Pack	Minature 	100	showit	2017-05-18 21:30:44.518+00	2017-05-18 21:30:44.518+00	10	\N	22	t	t	t	t	6
162	GWSpaceWolvesLongFangs	Space Wolves Long Fangs	3700	Games Workshop Space Wolves Long Fangs	\N	Space Wolves Long Fangs 	Minature 	100	showit	2017-05-18 21:33:37.922+00	2017-05-18 21:33:37.922+00	10	\N	22	t	t	t	t	6
163	GWWolfGuardTerminators	Wolf Guard Terminators 	5000	Games Workshop Wolf Guard Terminators 	\N	Wolf Guard Terminators 	Minature 	100	showit	2017-05-18 21:39:59.481+00	2017-05-18 21:39:59.481+00	10	\N	22	t	t	t	t	6
164	GWSpaceWolvesWulfen	Space Wolves Wulfen	6000	Games Workshop Space Wolves Wulfen 	\N	Space Wolves Wulfen 	Minature 	100	showit	2017-05-18 21:42:18.193+00	2017-05-18 21:42:18.193+00	10	\N	22	t	t	t	t	6
165	GWStormwolf	Stormwolf 	8100	Games Workshop Stormwolf	\N	Stormwolf	Minature 	100	showit	2017-05-18 21:44:07.015+00	2017-05-18 21:44:07.015+00	10	\N	22	t	t	t	t	8
166	GWStormfangGunship	Stormfang Gunship	8100	Games Workshop Stormfang Gunship	\N	Stormfang Gunship 	Minature 	100	showit	2017-05-18 21:46:37.16+00	2017-05-18 21:46:37.16+00	10	\N	22	t	t	t	t	8
167	GWSpaceWolvesVenerableDreadnought	Space Wolves Venerable Dreadnought 	5400	Games Workshop Space Wolves Venerable Dreadnought 	\N	Space Wolves Venerable Dreadnought 	Minature 	100	showit	2017-05-18 21:49:14.279+00	2017-05-18 21:49:14.279+00	10	\N	22	t	t	t	t	6
168	GWMurderfang	Murderfang	5400	Games Workshop Murderfang	\N	Murderfang	Minature 	100	showit	2017-05-18 21:51:05.675+00	2017-05-18 21:51:05.675+00	10	\N	22	t	t	t	t	8
169	GWWolfLordOnThunderwolf	Wolf Lord on Thunderwolf	4125	Games Workshop Wolf Lord on Thunderwolf 	\N	Wolf Lord on Thunderwolf 	Minature 	100	showit	2017-05-18 21:53:31.26+00	2017-05-18 21:53:31.26+00	10	\N	22	t	t	t	t	6
170	GWIronPriest	Iron Priest	3000	Games Workshop Iron Priest	\N	Iron Priest 	Minature 	100	showit	2017-05-18 21:55:46.215+00	2017-05-18 21:55:46.215+00	10	\N	22	t	t	t	t	4
171	GWWolfLordKrom	Wolf Lord Krom 	3000	Games Workshop Wolf Lord Krom	\N	Wolf Lord Krom	Minature 	100	showit	2017-05-18 21:57:34.589+00	2017-05-18 21:57:34.589+00	10	\N	22	t	t	t	t	4
172	GWFenrisianWolves	Fenrisian Wolves	2475	Games Workshop Fenrisian Wolves 	\N	Fenrisian Wolves 	Minature 	100	showit	2017-05-18 22:01:13.246+00	2017-05-18 22:01:13.246+00	10	\N	22	t	t	t	t	4
\.


--
-- Name: Products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Products_id_seq"', 172, true);


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

COPY "UserNotifications" (id, type, status, "fromId", "fromName", "fromUsername", "createdAt", "updatedAt", "UserId", details) FROM stdin;
178	allyRequestReceived	unRead	81	Zack Anselm	zdizzle6717	2017-05-26 01:25:04.325+00	2017-05-26 01:25:04.325+00	31	\N
179	allyRequestReceived	unRead	81	Zack Anselm	zdizzle6717	2017-05-26 20:28:25.306+00	2017-05-26 20:28:25.306+00	88	\N
183	allyRequestAccepted	unRead	81	Zack Anselm	zdizzle6717	2017-05-28 19:55:43.699+00	2017-05-28 19:55:43.699+00	90	\N
185	allyRequestAccepted	unRead	5	Bryce undefined	TheDude	2017-06-08 14:36:49.953+00	2017-06-08 14:36:49.953+00	91	\N
187	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 15:17:18.01+00	2017-06-18 15:17:18.01+00	12	Oldhammer Top 8
188	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 15:17:35.069+00	2017-06-18 15:17:35.069+00	12	Oldhammer Soldier
189	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 15:18:02.091+00	2017-06-18 15:18:02.091+00	31	Oldhammer Top 8
190	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 15:18:20.933+00	2017-06-18 15:18:20.933+00	31	Oldhammer Soldier
191	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 15:19:31.284+00	2017-06-18 15:19:31.284+00	16	Oldhammer Wooden Bolter
192	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 15:19:46.134+00	2017-06-18 15:19:46.134+00	16	Oldhammer Soldier
193	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 17:34:27.855+00	2017-06-18 17:34:27.855+00	93	Oldhammer Top 8
194	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 17:34:43.623+00	2017-06-18 17:34:43.623+00	93	Oldhammer Soldier
195	newAchievement	unRead	\N	\N	systemAdmin	2017-06-18 17:39:14.612+00	2017-06-18 17:39:14.612+00	93	Oldhammer Soldier
196	allyRequestReceived	unRead	81	Zack Anselm	zdizzle6717	2017-06-20 11:06:19.375+00	2017-06-20 11:06:19.375+00	91	\N
197	newAchievement	unRead	\N	\N	systemAdmin	2017-06-24 20:48:58.213+00	2017-06-24 20:48:58.213+00	94	Oldhammer Best Paint
\.


--
-- Name: UserNotifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"UserNotifications_id_seq"', 197, true);


--
-- Data for Name: UserPhotos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "UserPhotos" (id, "locationUrl", label, name, size, type, "createdAt", "updatedAt", "UserId", identifier) FROM stdin;
9	/players/3/playerIcon/test-photo.gif	\N	test-photo.gif	17855	image/gif	2017-04-12 23:20:28.728+00	2017-04-12 23:20:28.728+00	3	playerIcon
16	/players/81/playerIcon/	\N	icon.jpg	293983	image/jpeg	2017-05-15 02:42:47.929+00	2017-05-15 02:42:47.929+00	81	playerIcon
17	/players/5/playerIcon/	\N	IMG_0016.PNG	222929	image/png	2017-05-15 13:47:49.22+00	2017-05-15 13:47:49.22+00	5	playerIcon
19	/players/31/playerIcon/	\N	Necron.jpg	29972	image/jpeg	2017-05-20 18:39:52.69+00	2017-05-20 18:39:52.69+00	31	playerIcon
20	/players/84/playerIcon/	\N	IMG_1198.JPG	19242	image/jpeg	2017-05-22 20:06:22.399+00	2017-05-22 20:06:22.399+00	84	playerIcon
21	/players/89/playerIcon/	\N	HoDANGprofile.png	59644	image/png	2017-05-26 20:47:43.578+00	2017-05-26 20:47:43.578+00	89	playerIcon
22	/players/91/playerIcon/	\N	IMG_4123.JPG	76448	image/jpeg	2017-06-03 22:29:25.941+00	2017-06-03 22:29:25.941+00	91	playerIcon
\.


--
-- Name: UserPhotos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"UserPhotos_id_seq"', 22, true);


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

COPY "Users" (id, email, password, "firstName", "lastName", member, "tourneyAdmin", "eventAdmin", "newsContributor", "venueAdmin", "clubAdmin", "systemAdmin", username, club, "mainPhone", "mobilePhone", "streetAddress", "aptSuite", city, state, zip, dob, bio, facebook, twitter, instagram, "googlePlus", youtube, twitch, website, "rewardPoints", visibility, "shareContact", "shareName", "shareStatus", newsletter, marketing, sms, "allowPlay", icon, "eloRanking", "createdAt", "updatedAt", "UserId", subscriber, "accountActivated", "accountBlocked", "customerId", "hasAuthenticatedOnce", "rpPool", "eventAdminSubscriber") FROM stdin;
88	Hill400@hotmail.com	$2a$10$05QSYj1C3WuCgJzmpyzcyu3.Weptmj/ZE0KRSXFPuFij/TskiBKHG	Rickey	Lane	t	f	f	f	f	f	f	Damocles	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-05-22 19:43:35.16+00	2017-05-22 19:45:04.301+00	\N	f	t	f	\N	t	0	f
13	ajdimeola@yahoo.com	$2a$10$9/9HQyTea9qA1rHRuba58OTomT.X7ZEV93ULqXuC6BhQ2GCJoP8Ve	Anthony	DiMeola	t	f	f	f	f	f	f	Dr_Damo	\N	\N	\N	\N	\N	\N	\N	\N	\N	Play to have fun but will try agents what Evers op at the moment	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1476038032049-IMG_0384.JPG	0	2016-10-09 18:33:13.813+00	2016-10-09 18:39:07.865+00	\N	f	t	f	\N	f	0	f
18	riskhalo@hotmail.com	$2a$10$w2ZYpwALAy4xpKx20Gc68OxZzOGqX9lC3OcrpSkwyEMdrU2k1Lo8m	Austin	Brooks	t	f	f	f	f	f	f	Snow	\N	\N	\N	\N	\N	\N	\N	\N	\N	Space Marines!!!!!!!!!!	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 19:32:14.633+00	2016-10-09 19:33:12.227+00	\N	f	t	f	\N	f	0	f
32	bfreed96@gmail.com	$2a$10$aiXlytVv9d53b/Lz1uJ3iO2R1k.EnO2gHAJhQAiR9.b8fzFuyucEO	Branson	Freed	t	f	f	f	f	f	f	MastaFreed	\N	\N	\N	\N	\N	\N	\N	\N	\N	40k player: Adepta Sororitas/Sisters of Battle, Inquisition, Militarum Tempestus, Astra Militarum. Looking to try out new systems and explore all that tabletop war gaming has to offer!	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-12 07:50:59.151+00	2016-11-12 07:54:59.997+00	\N	f	t	f	\N	f	0	f
22	cpcarrot@aol.com	$2a$10$PsKAYcNR0MbNJhQiaHufBOv1nfH.sJLaJ1mjVBd674MsYfy0liWou	Mike	Hancho	t	f	f	f	f	f	f	Jesus hates you	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-10 02:02:33.645+00	2016-10-10 02:02:33.645+00	\N	f	t	f	\N	f	0	f
59	nova_lead@yahoo.com	$2a$10$07vIvLH6Az9kOX05C0Fjy.BJCm6S0LJ/qpMCT9PDzw/2P3W1TTow6	Jonathan	Elliott	t	f	f	f	f	f	f	Nova_lead	\N	\N	\N	\N	\N	\N	\N	\N	\N	New Player seeks Star Wars Armada gamers in Sacramento	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-23 03:48:27.328+00	2017-02-23 03:49:55.208+00	\N	f	t	f	\N	f	0	f
34	darkangel0@hotmail.com	$2a$10$amZk1SJmNabKjid0CyI6U.A3JM4BMSpwJE8PRU/TFir/8sBb5/k4C	Joshua	Costanich	f	f	f	f	t	f	f	Multiple	\N	\N	\N	\N	\N	\N	\N	\N	\N	Sacramento area Pressganger - PG Multiple	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	1486982190293-odin_by_design_by_humans-d8uyqd7.jpg	0	2016-11-15 22:56:25.42+00	2017-02-13 10:37:13.054+00	\N	f	t	f	\N	f	0	f
23	benvaun@yahoo.com	$2a$10$VuAMFArjPLl./B8GtXZo0.tjo2IUEvBzeR76.k.ytSI03lE9H4Sgq	Ben	Vaughan	t	f	f	f	f	f	f	BenVaughan	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-10 02:27:25.337+00	2016-10-10 02:27:25.337+00	\N	f	t	f	\N	f	0	f
11	vasquez.mason@yahoo.com	$2a$10$ju6Tzw6TARODdhkO6DK7PeDVLsnO4AYLugoMvzP8Wg8eOqg40TmFq	Mason	Vasquez	t	f	f	f	f	f	f	Masos	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 18:29:04.693+00	2016-10-09 18:29:04.693+00	\N	f	t	f	\N	f	0	f
6	torpored@yahoo.com	$2a$10$QfEBk7AQzzDqeTeb.7XFCuZry4eYqDsB5Z4OxSaLrDuxpSfopgAQe	Josh	Rosenstein	t	f	f	f	f	f	f	Torpored	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-08 00:05:13.552+00	2016-10-08 00:06:49.107+00	5	f	t	f	\N	f	0	f
24	scott.anderson1219@hotmail.com	$2a$10$ffdUlXVphnE9NLv8i4.TxuUedwP25o40Jr4jEBBnnqcn5aoVf09P6	Scott	Anderson	t	f	f	f	f	f	f	MysticMonkKern	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-22 16:41:18.218+00	2016-10-22 16:41:18.218+00	\N	f	t	f	\N	f	0	f
14	mccool.john@yahoo.com	$2a$10$rNL37Uq9YBq6WyubSZfv0eGp6e9vBT70Xgl3l0x6PMRorJDwa3aNO	John	Mccool	t	f	f	f	f	f	f	Mccoolislove	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 18:40:28.702+00	2016-10-09 18:40:28.702+00	\N	f	t	f	\N	f	0	f
15	floydfos@hotmail.com	$2a$10$YEs1eHCb5avO91T/e0pXm..phJP81XTTip1ek9eoi1HNmr/3Y6NnG	Austin	Warner	t	f	f	f	f	f	f	Redbeard	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 18:45:29.723+00	2016-10-09 18:45:29.723+00	\N	f	t	f	\N	f	0	f
25	cperriraz@gmail.com	$2a$10$RftelGD55sZcvRq102YdBukuuAIX6pjlNrhhVHsjB5rOY9NRwnRxC	Chris	Perriraz	t	f	f	f	f	f	f	CPerriraz	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-29 03:10:36.131+00	2016-10-29 03:10:36.131+00	\N	f	t	f	\N	f	0	f
17	lucas.g.king@gmail.com	$2a$10$yzFkt43NZA4c44wBLdwHw.hx0UhDno.wJtSy/qPVS6TlrJB7XRpxe	Lucas	King	t	f	f	f	f	f	f	Moriks	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 19:27:45.837+00	2016-10-09 19:27:45.837+00	\N	f	t	f	\N	f	0	f
19	rolgnek@gmail.com	$2a$10$1RrUc/BV9/rDjEfIaYRn8ODuUeb0GEyKZq8MZtV/d8EzV1WkGOfIi	Steve	Sisk	t	f	f	f	f	f	f	Rolgnek	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 20:12:51.717+00	2016-10-09 20:12:51.717+00	\N	f	t	f	\N	f	0	f
20	docdragonis@yahoo.com	$2a$10$nwbzRGKwaRhxweit02XJiezi8j.qz9R/79wdO9OGLdIALi8E.JrgW	Doc	Dragon	t	f	f	f	f	f	f	Docdragon	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 20:45:54.773+00	2016-10-09 20:45:54.773+00	\N	f	t	f	\N	f	0	f
28	sthiers@ymail.com	$2a$10$ZzcfFwWtPIxLZys51wRxv.hxEz.CxEipYjM2NKprTUC8DRqgybRTu	Shaun	Thiers	t	f	f	f	f	f	f	Lodbrok	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-02 22:46:04.082+00	2016-11-02 22:46:04.082+00	\N	f	t	f	\N	f	0	f
16	luke.pallas@gmail.com	$2a$10$cW6KC8TZDYghMTp//.vk/uRFuBrtToZD.zm4nVfgsj9xTuARfTh3.	Luke	Pallas	t	f	f	f	f	f	f	Dustin1209	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 19:24:43.418+00	2016-11-12 05:50:26.598+00	\N	f	t	f	\N	f	0	f
36	jorgemikekirby@yahoo.com	$2a$10$TyDgLNAubNFP4qhhkxqqJeKOKkTQVoLnYhrv7PDnjDYenS2dLZTvm	Jorge	Kirby	t	f	f	f	f	f	f	Nubalish	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-18 02:25:42.893+00	2016-11-18 02:26:00.28+00	\N	f	t	f	\N	f	0	f
21	loyce8869@gmail.com	$2a$10$TaRS0e8JvTe0Fvo/JBja0u1nrFGGfc7QtrSoPOD6haHFzUKuJh5nW	Mike	Benton	t	f	f	f	f	f	f	Loyce8869	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-10 01:57:23.566+00	2017-02-19 06:44:46.934+00	\N	f	t	f	\N	f	0	f
26	heathernana27@gmail.com	$2a$10$/K8QLYwvQyiALA5ITcRl/u4jHrtqkaJUblaTWaf0bFC/xc2vOmkCG	Heather	Leggett	t	f	f	f	f	f	f	Nekimalovelace	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-29 03:18:10.004+00	2016-11-18 03:34:47.138+00	\N	f	t	f	\N	f	0	f
35	ryuondo@gmail.com	$2a$10$jWg8h5CKMoQ69L88erdfSeBOPDwJ3Lq7/VFEPIOcDAJu7yGeKsjJ2	Zachary	Walker	t	f	f	f	f	f	f	Ryuondo	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-15 23:50:58.036+00	2016-11-15 23:50:58.036+00	\N	f	t	f	\N	f	0	f
37	nolanenator@gmail.com	$2a$10$mIJFUEcBmrDnvfkzLNT2e.WUzco7oZyRKOLNSV1RC3GemyDbj7lIS	nolan	bloyd	t	f	f	f	f	f	f	Loki	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-19 00:32:32.918+00	2016-11-19 00:32:32.918+00	\N	f	t	f	\N	f	0	f
38	daniel.hau.yau@gmail.com	$2a$10$zQulfFS.X5x4j6wp6iow8Ovs1baIeugBHSMg6cVrcn17mqEugFRgK	Daniel	Hau	t	f	f	f	f	f	f	TacosInDistress	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-19 00:37:26.177+00	2016-11-19 00:37:26.177+00	\N	f	t	f	\N	f	0	f
39	reinwald@hotmail.com	$2a$10$7EnBaZ0l5S7kx5Oy03F5.OnHP3Z/I.jfRbUHMzyHG1yYuasgQ/vKG	josh	reinwald	t	f	f	f	f	f	f	reinwald	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-19 08:26:06.087+00	2016-11-19 08:26:06.087+00	\N	f	t	f	\N	f	0	f
41	thisbeapanda@gmail.com	$2a$10$bfbIqzMy3hyDmjPkWEaGHOr/ZXc9cK7UrnBHAh7cwa/69V.4bRM3u	Peter	Opdahl	t	f	f	f	f	f	f	Pandan0w	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1479778105251-80dc606b4d738398b039827599e2946489b13d49d4696bf8f6d2cccdac13a228u18.png	0	2016-11-22 01:27:05.035+00	2016-11-22 01:28:25.577+00	\N	f	t	f	\N	f	0	f
51	mttmart@gmail.com	$2a$10$32XWSEUzw5kLKTa59.l.iO83jg4NUMew.W1qhsVSQ0B2KCxx8547u	Matthew	Martini	t	f	f	f	f	f	f	Grotliquor	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	2400	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 19:28:46.912+00	2017-02-20 20:14:47.859+00	\N	f	t	f	\N	f	0	f
12	dayone916@outlook.com	$2a$10$4XdH6UN4plWQTiFqU/WwHeeBPiiCM9CZCM8hOIoQmvB9ozpJOB96a	Tony	Myers	f	f	f	f	t	f	f	Dayone916	\N	9167160053	\N	\N	\N	\N	\N	\N	\N	40k player: space marines, eldar, grey Knights, admech/warconvocation, imperial knights\n\nCofounder / club president of meta mafia\n\nOwner of Hammerhead Games	\N	\N	\N	\N	\N	\N	\N	1100	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-09 18:32:49.606+00	2017-05-14 13:28:11.502+00	\N	f	t	f	\N	f	0	f
43	oelber@gmail.com	$2a$10$DRquUkAnd53lySsI4gIadO2yR1ReNnQYCew9rYPdyzCmgmhtgI8H.	Colby	Cram	t	f	f	f	f	f	f	Oelber	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-01-26 05:29:06.287+00	2017-01-26 05:29:06.287+00	\N	f	t	f	\N	f	0	f
46	sergio.rodriguez421@yahoo.com	$2a$10$AtXnkwaokOwbHpq3BApbquMN9ibRgn4gsF/0bYPiG0WxXaEWYbAE2	Sergio	Rodriguez	t	f	f	f	f	f	f	Seated	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 12:49:33.894+00	2017-02-28 23:48:38.374+00	\N	f	t	f	\N	f	0	f
58	johnr.schroeder9@gmail.com	$2a$10$2AU3pgKGo3R4iSHOdiZnz.SY/KrYqfl4ETUMwrp4HArwovoV4L0vq	John	Schroeder	t	f	f	f	f	f	f	Jonjonbegon	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-22 23:34:05.008+00	2017-02-22 23:34:05.008+00	\N	f	t	f	\N	f	0	f
44	CaptCommy@gmail.com	$2a$10$/D/Z1T39l20k77Tw6y9dVuulWedBRsuodGYphucuIHjm.FsWJ4/di	Nate	Horn	t	f	f	f	f	f	f	CaptCommy	\N	5859199329	\N	10741 Fair Oaks Blvd	Apt 75	Fair Oaks	California	95628	\N	...	\N	\N	\N	\N	\N	\N	\N	4500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-12 01:20:22.377+00	2017-02-20 20:15:30.049+00	\N	f	t	f	\N	f	0	f
56	marcellinr@gmail.com	$2a$10$ky7vdXYhYjt8lRLIEYPPIexblhx.LCcNDYKMf5WusAfGiIb69gt62	Ryan	Marcellin	t	f	f	f	f	f	f	Marcellin	\N	\N	\N	\N	\N	Tracy	California	95376	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-14 21:36:37.886+00	2017-02-14 21:37:35.34+00	\N	f	t	f	\N	f	0	f
48	oliwat@comcast.net	$2a$10$JMacQTt7JBFKwPGKeN.37e1yKFCyBV9f.TJPBEh/JD00pXF6FENdm	Steve	Oliver	t	f	f	f	f	f	f	Stoliver	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	3500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 14:42:46.038+00	2017-02-15 23:08:24.509+00	\N	f	t	f	\N	f	0	f
52	reinwood99@hotmail.com	$2a$10$HgdG6Ev5XJioxYoN5RjhNewbh6VelAZMTL/QNlkbOIidpLD9O7leS	Jason	David	t	f	f	f	f	f	f	Reinwood	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 23:42:56.963+00	2017-02-15 23:11:11.65+00	\N	f	t	f	\N	f	0	f
45	Michaelcarbone@ymail.com	$2a$10$MDiMOab.Lk0GgnMkoyqPK.9JM5chf8BvS9v2U2n37wmRBCrs4vkRe	Michael	Carbone	t	f	f	f	f	f	f	Blacktoad69	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 02:03:21.005+00	2017-02-15 23:12:27.69+00	\N	f	t	f	\N	f	0	f
53	aaron.dvillarreal@gmail.com	$2a$10$/obX4pQkS01Sb/r5FFmtrOUA0mqEbLFou5IQyynxr4x2FppQv0Ob.	Aaron	Villarreal	t	f	f	f	f	f	f	Aarondv	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-14 01:51:37.656+00	2017-02-20 20:16:05.329+00	\N	f	t	f	\N	f	0	f
47	harkinconner@yahoo.com	$2a$10$q2nEs0lcQ.QMLbxf5LBOGetKNgCLxrW.jPxVB5xVN690cAgyCLhWe	Conner	Harkin	t	f	f	f	f	f	f	Psykes7	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 14:30:55.71+00	2017-02-20 20:16:38.498+00	\N	f	t	f	\N	f	0	f
57	mitchellallanryan@hotmail.com	$2a$10$Dqdxajk2MtgBMS2qDOmES.iI.YvReijMKUxE8I0.Sl/CcprOo1u.i	Mitchell	Ryan	t	f	f	f	f	f	f	ALogicalFallacy	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	5500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-20 21:42:35.461+00	2017-03-27 22:56:06.289+00	\N	f	t	f	\N	f	0	f
50	rjy22@ymail.com	$2a$10$xqErFRTeBfYIPcrf0nbwNeIW00Ng3LGv/6wkI9ViFcETgHl2zzsQW	Ryan	Yamadera	t	f	f	f	f	f	f	Samiel	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	3500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 17:55:18.801+00	2017-03-27 22:54:56.496+00	\N	f	t	f	\N	f	0	f
49	phantasmagorium@gmail.com	$2a$10$5awLe4TGuYupp7NekqWQHedreJR1OM2HbqlHz8r8CGsv1gUy7nhty	Trevor	Bond	t	f	f	f	f	f	f	sedated	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	1500	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-13 15:09:52.084+00	2017-03-27 22:53:47.667+00	\N	f	t	f	\N	f	0	f
60	dustinlane62@yahoo.com	$2a$10$lywtFGh7xFXK4OKXoMbPGeLOZ7eb/MXfKg7R8e0J3tXnAkfb9mCo6	Dustin	Lane	t	f	f	f	f	f	f	Dustin lane	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-23 20:08:46.858+00	2017-02-23 20:08:46.858+00	\N	f	t	f	\N	f	0	f
40	GordonDanke@gmail.com	$2a$10$Hf145n.ajn/2PsWo5P/NrO6WLP9ciLfNfBAsLOCbZcPLRPKDLtJPi	Gordon	Danke	f	f	f	f	f	f	t	DarkLink	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-20 20:38:32.694+00	2016-11-20 20:47:42.822+00	\N	f	t	f	\N	f	0	f
42	david95608@hotmail.com	$2a$10$Fz4/yNp4B3pypNi.gNchleI8HWCY2EUYVvjdUArkm3tnR2QjOTUei	David	Parigini	f	f	f	f	f	f	t	Servitor X	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-12-12 01:02:52.966+00	2017-01-16 00:10:15.205+00	\N	f	t	f	\N	f	0	f
30	asyouwish1978@gmail.com	$2a$10$YjKNPbUz4I2VgyWde1rmiOJ25DL0cfOxu.9eRcCtBDkaskp3Fw3P.	Crissy	Dubois	f	f	f	f	t	f	f	TyrantButtercup	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-08 16:44:24.526+00	2016-11-10 16:01:09.916+00	\N	f	t	f	\N	f	0	f
29	spalmer286@gmail.com	$2a$10$jgqcsVS301.i5q3aq0WTRuLuw/xZncyGR5BkG.oJMdOt.OLcUqbYe	Sean	Palmer	f	f	f	f	t	f	f	The Canuck	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-05 17:38:37.547+00	2017-02-03 19:53:56.953+00	\N	f	t	f	\N	f	0	f
33	predator_47_47@yahoo.com	$2a$10$tLL50MwMlZSnGtvJHdG9ReLYQl0eiYVaB4zD46ImRt5lbiNX8i00.	Marcus	Aurelius	f	f	f	f	t	f	f	Aurelius47	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-15 21:09:12.695+00	2016-11-29 17:58:09.993+00	\N	f	t	f	\N	f	0	f
27	richard.sparks1976@yahoo.com	$2a$10$qUIXy3WFicCuu6dhZK7xbeqWYjGdzQ/s3ngjPB/fNl7cjxZStYAXq	Richard	Sparks	f	f	f	f	t	f	f	Richard	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-02 22:11:15.967+00	2016-11-15 22:06:00.018+00	\N	f	t	f	\N	f	0	f
7	zack@treemachinerecords.com	$2a$10$x1hhFy9dNHJaDKTpXz/v2ejkvDwSJt9gqJTkDbbrympXX2TV6FyX2	Tree	Machine	t	f	f	f	f	f	f	treemachine	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1475885423617-FWI_Logo_Alt.png	0	2016-10-08 00:10:01.582+00	2016-10-08 00:39:48.836+00	\N	f	t	f	\N	f	0	f
85	gdanke88@hotmail.com	$2a$10$baOzjV.jL.GrbogwEMiAOe1lUsXFcMZIoMTaVWovkBsHTfUO6HGla	Gordon	Danke	t	f	f	f	f	f	f	Darklink	\N	\N	\N	3100 Countryside Drive	\N	Placerville	CA	95667	\N	Text here	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-05-08 14:27:10.341+00	2017-05-08 14:34:23.218+00	\N	f	t	f	\N	f	0	f
55	hiett4@att.net	$2a$10$Jbp23Lori9ijm6JM7vzn2e0182el7uQw.iEYTQMmrsPM5H79tdJgK	Travis	Hiett	t	f	f	f	f	f	f	Travh20	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	1000	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-14 04:13:09.589+00	2017-05-14 13:30:15.932+00	\N	f	t	f	\N	f	0	f
3	systemAdmin@email.com	$2a$10$jBT86eITj0EkBC60x4BMHeJU1FPN3Tvbax9szyh30LBQZGJsVfjHW	System	Admin	f	f	f	f	f	f	t	systemAdmin	\N	\N	\N	\N	\N	\N	\N	\N	\N	I'm in the system!  Main user account.	https://facebook.com/battlecomm	https://twitter.com/battle_comm	\N	\N	\N	\N	\N	10700	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-10-06 23:18:13.267+00	2017-05-15 02:35:34.824+00	\N	f	t	f	\N	t	0	f
87	jeff_woodard@hotmail.com	$2a$10$PMz/ifUNEH2L0jxnJ0v7pO/n5wfTfdnQsIzsqaIXbCQlPRKHAz.B6	James	Gaines	t	f	f	f	f	f	f	jeff_woodard@hotmail.com	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-05-15 23:50:55.485+00	2017-05-15 23:51:08.839+00	\N	f	t	f	\N	t	0	f
86	Jsnelson47@hotmail.com	$2a$10$qr2kLTxdj5UDtHujJy71yuGQPBQNzt5ZTh.heYsc7JUFefO1DWfNa	Steve	Nelson	t	f	f	f	f	f	f	Nellie	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-05-15 00:03:34.862+00	2017-05-18 22:04:47.355+00	\N	f	t	f	\N	t	0	f
31	Omegaprime69@Gmail.com	$2a$10$d0g6myRQsxgBnPvsaLQIye6OaKacZxRS6AVBOZHNwYcV4XU.2sPIu	Mark	Broughton	f	f	f	f	t	f	f	Omegaprime	\N	\N	\N	1250 Howe Ave	3A	Sacramento	CA	85925	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2016-11-12 02:19:18.322+00	2017-05-20 17:58:01.388+00	\N	f	t	f	\N	t	0	f
84	Biffster72@gmail.com	$2a$10$7/xTXy6hynCGvOuyOixZLu9/CmVbWXXX7W6yAURbgRQvI7lTU9JBi	Bryce	Nelson	f	f	f	f	f	f	f	TheRealDude	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-04-28 00:51:19.385+00	2017-05-24 21:48:12.325+00	\N	t	t	f	\N	t	1000	f
89	dganselm@gmail.com	$2a$10$Obz09VsE5oy13MRT7fk1BOw5qL68vLgVuX9crVzkpW3lINhnD9Cga	asdf	asdf	t	f	f	f	f	f	f	HoDANG	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-05-26 20:36:25.259+00	2017-05-26 20:40:38.973+00	\N	f	t	f	\N	t	0	f
81	zanselm5@gmail.com	$2a$10$dyMb9OioxkUU1I5Z0oFrpOuliPIy8ZoZa6AYMzjup62HkAOqjChju	Zack	Anselm	t	f	f	f	f	f	f	zdizzle6717	\N	3175448348	\N	\N	\N	\N	\N	\N	\N	...I am Zack, and this is me.	\N	\N	\N	\N	\N	\N	\N	16450	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-04-15 15:57:47.527+00	2017-05-25 10:55:23.692+00	\N	f	t	f	cus_AgKQLy2jJSQ4Yp	t	0	f
5	bnelson@battle-comm.com	$2a$10$SQYzPfY9aJytVSZhEojE.ugWRARUsHU0VZxvd6YFMIPMJg2008pxi	Bryce	Nelson	f	f	t	f	f	f	f	TheDude	\N		\N	3624 Jenny Lind Ave	\N	North Highlands 	California 	95660	\N	The dude is the dude...is the dude!		\N	\N	\N	\N	\N	\N	1750	\N	\N	\N	\N	\N	\N	\N	\N	1475812710783-IMG_0016.PNG	0	2016-10-07 01:48:21.117+00	2017-05-25 21:35:37.076+00	\N	f	t	f	\N	t	5000	f
91	EL_Ravager@live.com	$2a$10$YM/kTTftUSZZbS5vJLeoVO4f5W8QB3.UDyXnyTu0ZVo2vbKpDAM9u	Justin	Takemoto	t	f	f	f	f	f	f	ELRavager	\N	\N	\N	\N	\N	\N	\N	\N	\N	Ork Player \nWaaagh\nTeam games: My bro plays Tau 	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-06-03 22:19:58.839+00	2017-06-03 22:28:32.533+00	\N	f	t	f	\N	t	0	f
90	Schlenger.grant@gmail.com	$2a$10$ufU7xrVpuBbW5urwS3XfNuV..WtJBiKV8E8rp2BWSLKU1q3FhLP9G	Grant	Schlenger	t	f	f	f	f	f	f	Schlenger	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-05-28 15:47:07.928+00	2017-05-28 19:56:46.546+00	\N	f	t	f	\N	t	0	f
92	Snowball99@gmail.com	$2a$10$.1N6nJql6CEebIrBR9bkuuMgR.7HDscQolcqC2bOqExVwnyQkyaHS	Wayne	Rogers	t	f	f	f	f	f	f	Waynbo	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-06-08 17:59:58.052+00	2017-06-08 18:00:35.807+00	\N	f	t	f	\N	t	0	f
54	adam.slupik@gmail.com	$2a$10$WwU72vCbfxUIWAIBofUJMeq05uWOjXPpE0jxWPosbnp3a63aD1V6K	Adam	Slupik	t	f	f	f	f	f	f	Enjeru	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	1300	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-02-14 01:56:59.351+00	2017-06-10 00:25:19.272+00	\N	f	t	f	\N	t	0	f
93	CharleswJonesii@Gmail.com	$2a$10$oN8yzYr2602Lfu5tCwOIju.LC3kWfOoEIcZUb9VLxmkm1hIiqBdYa	Charles	Jones	t	f	f	f	f	f	f	ChuckJones	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-06-18 17:26:01.679+00	2017-06-18 17:26:22.668+00	\N	f	t	f	\N	t	0	f
94	n3obud@gmail.com	$2a$10$fyVh/.gDt83GQZgUqLAEtO6oyZwAwGdi1rUMcmAQhPCZgWk1OxlHO	Brandon	Killmeyer	t	f	f	f	f	f	f	TheBrandonOne	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-06-18 19:02:21.199+00	2017-06-18 19:02:42.337+00	\N	f	t	f	\N	t	0	f
95	Johnfhs24@gmail.com	$2a$10$QTw8Pl4YzTJZYF6oyEs38eF2ejZQbJXXYl3t99CTkfqq3CNXm3Dne	John	Forsythe	t	f	f	f	f	f	f	Johnfhs24	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-07-03 17:20:51.843+00	2017-07-03 17:21:13.614+00	\N	f	t	f	\N	t	0	f
96	johnfhs24@gmail.com	$2a$10$Zjtqjn2zouqZSqk7P8C.QOPPeqTcoDom98OKa26OPvzNvNCfNH6JK	John	Forsythe	t	f	f	f	f	f	f	johnfhs24	\N	\N	\N	\N	\N	\N	\N	\N	\N	...	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	profile_image_default.png	0	2017-07-03 17:24:40.011+00	2017-07-03 17:24:55.293+00	\N	f	t	f	\N	t	0	f
\.


--
-- Name: Users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bcadmin
--

SELECT pg_catalog.setval('"Users_id_seq"', 96, true);


--
-- Data for Name: userHasAchievements; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "userHasAchievements" ("createdAt", "updatedAt", "AchievementId", "UserId") FROM stdin;
2017-05-14 23:38:51.129+00	2017-05-14 23:38:51.129+00	4	81
2017-05-18 23:10:53.496+00	2017-05-18 23:10:53.496+00	1	81
2017-05-18 23:15:16.135+00	2017-05-18 23:15:16.135+00	2	81
2017-05-18 23:16:13.22+00	2017-05-18 23:16:13.22+00	3	81
2017-06-16 14:44:11.653+00	2017-06-16 14:44:11.653+00	21	5
2017-06-18 15:17:18+00	2017-06-18 15:17:18+00	17	12
2017-06-18 15:17:35.064+00	2017-06-18 15:17:35.064+00	19	12
2017-06-18 15:18:02.087+00	2017-06-18 15:18:02.087+00	17	31
2017-06-18 15:18:20.928+00	2017-06-18 15:18:20.928+00	19	31
2017-06-18 15:19:31.278+00	2017-06-18 15:19:31.278+00	18	16
2017-06-18 15:19:46.13+00	2017-06-18 15:19:46.13+00	19	16
2017-06-18 17:34:27.842+00	2017-06-18 17:34:27.842+00	17	93
2017-06-18 17:34:43.62+00	2017-06-18 17:34:43.62+00	19	93
2017-06-24 20:48:58.203+00	2017-06-24 20:48:58.203+00	16	94
\.


--
-- Data for Name: userHasFriends; Type: TABLE DATA; Schema: public; Owner: bcadmin
--

COPY "userHasFriends" ("createdAt", "updatedAt", "UserId", "FriendId") FROM stdin;
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
2017-05-01 04:05:03.721+00	2017-05-01 04:05:03.721+00	5	81
2017-05-01 04:05:03.732+00	2017-05-01 04:05:03.732+00	81	5
2017-05-22 19:52:08.909+00	2017-05-22 19:52:08.909+00	84	81
2017-05-22 19:52:08.917+00	2017-05-22 19:52:08.917+00	81	84
2017-05-26 20:49:09.873+00	2017-05-26 20:49:09.873+00	81	89
2017-05-26 20:49:09.879+00	2017-05-26 20:49:09.879+00	89	81
2017-05-28 19:55:42.89+00	2017-05-28 19:55:42.89+00	81	90
2017-05-28 19:55:42.898+00	2017-05-28 19:55:42.898+00	90	81
2017-06-08 14:36:49.587+00	2017-06-08 14:36:49.587+00	5	91
2017-06-08 14:36:49.597+00	2017-06-08 14:36:49.597+00	91	5
\.


--
-- Name: Achievements_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Achievements"
    ADD CONSTRAINT "Achievements_pkey" PRIMARY KEY (id);


--
-- Name: Achievements_title_key; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Achievements"
    ADD CONSTRAINT "Achievements_title_key" UNIQUE (title);


--
-- Name: BannerSlides_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "BannerSlides"
    ADD CONSTRAINT "BannerSlides_pkey" PRIMARY KEY (id);


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
-- Name: Files_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Files"
    ADD CONSTRAINT "Files_pkey" PRIMARY KEY (id);


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
-- Name: UserPhotos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "UserPhotos"
    ADD CONSTRAINT "UserPhotos_pkey" PRIMARY KEY (id);


--
-- Name: UserRankings_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "UserRankings"
    ADD CONSTRAINT "UserRankings_pkey" PRIMARY KEY (id);


--
-- Name: Users_customerId_key; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_customerId_key" UNIQUE ("customerId");


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
-- Name: userHasAchievements_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "userHasAchievements"
    ADD CONSTRAINT "userHasAchievements_pkey" PRIMARY KEY ("AchievementId", "UserId");


--
-- Name: userHasFriends_pkey; Type: CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "userHasFriends"
    ADD CONSTRAINT "userHasFriends_pkey" PRIMARY KEY ("UserId", "FriendId");


--
-- Name: Achievements_GameSystemId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "Achievements"
    ADD CONSTRAINT "Achievements_GameSystemId_fkey" FOREIGN KEY ("GameSystemId") REFERENCES "GameSystems"(id) ON UPDATE CASCADE ON DELETE SET NULL;


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
-- Name: Files_GameSystemId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Files"
    ADD CONSTRAINT "Files_GameSystemId_fkey" FOREIGN KEY ("GameSystemId") REFERENCES "GameSystems"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Files_ManufacturerId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Files"
    ADD CONSTRAINT "Files_ManufacturerId_fkey" FOREIGN KEY ("ManufacturerId") REFERENCES "Manufacturers"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Files_NewsPostId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Files"
    ADD CONSTRAINT "Files_NewsPostId_fkey" FOREIGN KEY ("NewsPostId") REFERENCES "NewsPosts"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Files_ProductId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Files"
    ADD CONSTRAINT "Files_ProductId_fkey" FOREIGN KEY ("ProductId") REFERENCES "Products"(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: Files_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Files"
    ADD CONSTRAINT "Files_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE SET NULL;


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
-- Name: UserPhotos_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
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
-- Name: userHasAchievements_AchievementId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "userHasAchievements"
    ADD CONSTRAINT "userHasAchievements_AchievementId_fkey" FOREIGN KEY ("AchievementId") REFERENCES "Achievements"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: userHasAchievements_UserId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bcadmin
--

ALTER TABLE ONLY "userHasAchievements"
    ADD CONSTRAINT "userHasAchievements_UserId_fkey" FOREIGN KEY ("UserId") REFERENCES "Users"(id) ON UPDATE CASCADE ON DELETE CASCADE;


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

