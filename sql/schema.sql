CREATE TABLE `addressbook` (
  `id` integer  NOT NULL PRIMARY KEY AUTOINCREMENT
,  `firstname` varchar(255) NOT NULL
,  `lastname` varchar(255) NOT NULL
,  `address` text NOT NULL
,  `home` text NOT NULL
,  `mobile` text NOT NULL
,  `work` text NOT NULL
,  `email` text NOT NULL
,  `email2` text NOT NULL
,  `website` varchar(255) NOT NULL
,  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
);
CREATE TABLE `annonces` (
  `numero` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `nom` varchar(45) DEFAULT NULL
,  `auteur` varchar(30) DEFAULT NULL
,  `email` varchar(50) DEFAULT NULL
,  `contenu` blob NOT NULL
,  `rubrique` varchar(20) DEFAULT NULL
,  `prix` integer  NOT NULL DEFAULT 0
,  `telephone` varchar(16) DEFAULT NULL
,  `date` integer DEFAULT NULL
);
CREATE TABLE `chat` (
  `chat_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `chat_name` varchar(64) DEFAULT NULL
,  `start_time` datetime DEFAULT NULL
);
CREATE TABLE `galbumlist` (
  `id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `folder` varchar(200) DEFAULT NULL
,  `nom` varchar(200) NOT NULL DEFAULT ''
,  `descr` varchar(250) NOT NULL DEFAULT ''
,  `place` integer NOT NULL DEFAULT 0
,  `image` varchar(200) NOT NULL DEFAULT 'none'
,  `hits` integer NOT NULL DEFAULT 0
,  `gere` text  NOT NULL DEFAULT 'standalone'
,  `idpere` integer NOT NULL DEFAULT 0
,  `passwd` varchar(50) DEFAULT NULL
,  `secureid` varchar(20) DEFAULT NULL
);
CREATE TABLE `gimagelist` (
  `id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `date_verif` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `label` varchar(250) NOT NULL DEFAULT ''
,  `url` varchar(200) NOT NULL DEFAULT ''
,  `album` integer NOT NULL DEFAULT 0
,  `hits` integer NOT NULL DEFAULT 0
);
CREATE TABLE `message` (
  `message_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `chat_id` integer NOT NULL DEFAULT 0
,  `user_id` integer NOT NULL DEFAULT 0
,  `user_name` varchar(64) DEFAULT NULL
,  `message` text DEFAULT NULL
,  `post_time` datetime DEFAULT NULL
);
CREATE TABLE `pgv_blocks` (
  `b_id` integer NOT NULL DEFAULT 0
,  `b_username` varchar(100) DEFAULT NULL
,  `b_location` varchar(30) DEFAULT NULL
,  `b_order` integer DEFAULT NULL
,  `b_name` varchar(255) DEFAULT NULL
,  `b_config` text DEFAULT NULL
,  PRIMARY KEY (`b_id`)
);
CREATE TABLE `pgv_families` (
  `f_id` varchar(30) DEFAULT NULL
,  `f_file` varchar(255) DEFAULT NULL
,  `f_husb` varchar(30) DEFAULT NULL
,  `f_wife` varchar(30) DEFAULT NULL
,  `f_chil` varchar(255) DEFAULT NULL
,  `f_gedcom` text DEFAULT NULL
);
CREATE TABLE `pgv_favorites` (
  `fv_id` integer NOT NULL DEFAULT 0
,  `fv_username` varchar(30) DEFAULT NULL
,  `fv_gid` varchar(10) DEFAULT NULL
,  `fv_type` varchar(10) DEFAULT NULL
,  `fv_file` varchar(100) DEFAULT NULL
,  PRIMARY KEY (`fv_id`)
);
CREATE TABLE `pgv_individuals` (
  `i_id` varchar(30) DEFAULT NULL
,  `i_file` varchar(255) DEFAULT NULL
,  `i_rin` varchar(30) DEFAULT NULL
,  `i_name` varchar(255) DEFAULT NULL
,  `i_isdead` integer DEFAULT 1
,  `i_gedcom` text DEFAULT NULL
,  `i_letter` varchar(5) DEFAULT NULL
,  `i_surname` varchar(100) DEFAULT NULL
);
CREATE TABLE `pgv_messages` (
  `m_id` integer NOT NULL DEFAULT 0
,  `m_from` varchar(255) DEFAULT NULL
,  `m_to` varchar(30) DEFAULT NULL
,  `m_subject` varchar(255) DEFAULT NULL
,  `m_body` text DEFAULT NULL
,  `m_created` varchar(255) DEFAULT NULL
,  PRIMARY KEY (`m_id`)
);
CREATE TABLE `pgv_names` (
  `n_gid` varchar(30) DEFAULT NULL
,  `n_file` varchar(255) DEFAULT NULL
,  `n_name` varchar(255) DEFAULT NULL
,  `n_letter` varchar(5) DEFAULT NULL
,  `n_surname` varchar(100) DEFAULT NULL
,  `n_type` varchar(10) DEFAULT NULL
);
CREATE TABLE `pgv_news` (
  `n_id` integer NOT NULL DEFAULT 0
,  `n_username` varchar(100) DEFAULT NULL
,  `n_date` integer DEFAULT NULL
,  `n_title` varchar(255) DEFAULT NULL
,  `n_text` text DEFAULT NULL
,  PRIMARY KEY (`n_id`)
);
CREATE TABLE `pgv_other` (
  `o_id` varchar(30) DEFAULT NULL
,  `o_file` varchar(255) DEFAULT NULL
,  `o_type` varchar(20) DEFAULT NULL
,  `o_gedcom` text DEFAULT NULL
);
CREATE TABLE `pgv_placelinks` (
  `pl_p_id` integer DEFAULT NULL
,  `pl_gid` varchar(30) DEFAULT NULL
,  `pl_file` varchar(255) DEFAULT NULL
);
CREATE TABLE `pgv_places` (
  `p_id` integer NOT NULL DEFAULT 0
,  `p_place` varchar(150) DEFAULT NULL
,  `p_level` integer DEFAULT NULL
,  `p_parent_id` integer DEFAULT NULL
,  `p_file` varchar(255) DEFAULT NULL
,  PRIMARY KEY (`p_id`)
);
CREATE TABLE `pgv_sources` (
  `s_id` varchar(30) DEFAULT NULL
,  `s_file` varchar(255) DEFAULT NULL
,  `s_name` varchar(255) DEFAULT NULL
,  `s_gedcom` text DEFAULT NULL
);
CREATE TABLE `pgv_users` (
  `u_username` varchar(30) NOT NULL DEFAULT ''
,  `u_password` varchar(255) DEFAULT NULL
,  `u_fullname` varchar(255) DEFAULT NULL
,  `u_gedcomid` text DEFAULT NULL
,  `u_rootid` text DEFAULT NULL
,  `u_canadmin` char(2) DEFAULT NULL
,  `u_canedit` text DEFAULT NULL
,  `u_email` text DEFAULT NULL
,  `u_verified` varchar(20) DEFAULT NULL
,  `u_verified_by_admin` varchar(20) DEFAULT NULL
,  `u_language` varchar(50) DEFAULT NULL
,  `u_pwrequested` varchar(20) DEFAULT NULL
,  `u_reg_timestamp` varchar(50) DEFAULT NULL
,  `u_reg_hashcode` varchar(255) DEFAULT NULL
,  `u_theme` varchar(50) DEFAULT NULL
,  `u_loggedin` char(2) DEFAULT NULL
,  `u_sessiontime` integer DEFAULT NULL
,  `u_contactmethod` varchar(20) DEFAULT NULL
,  `u_visibleonline` char(2) DEFAULT NULL
,  `u_editaccount` char(2) DEFAULT NULL
,  `u_defaulttab` integer DEFAULT NULL
,  PRIMARY KEY (`u_username`)
);
CREATE TABLE `tresors` (
  `id` integer  NOT NULL PRIMARY KEY AUTOINCREMENT
,  `url_mini` varchar(255) NOT NULL DEFAULT ''
,  `url_tresor` varchar(255) NOT NULL DEFAULT ''
,  `commentaire` text NOT NULL
,  `date` date NOT NULL DEFAULT '0000-00-00'
,  `categorie` varchar(10) NOT NULL DEFAULT 'Divers'
);
CREATE TABLE `users` (
  `IDusers` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `prenom` varchar(20) NOT NULL DEFAULT ''
,  `nom` varchar(20) NOT NULL DEFAULT ''
,  `adresse` varchar(50) NOT NULL DEFAULT ''
,  `adresse2` varchar(50) NOT NULL DEFAULT ''
,  `cpostal` varchar(5) NOT NULL DEFAULT ''
,  `ville` varchar(20) NOT NULL DEFAULT ''
,  `pseudo` varchar(20) NOT NULL DEFAULT ''
,  `email` varchar(40) NOT NULL DEFAULT ''
,  `mdp` varchar(20) NOT NULL DEFAULT ''
,  `statut` varchar(10) NOT NULL DEFAULT ''
,  `age` char(2) NOT NULL DEFAULT ''
,  `linkann` varchar(200) DEFAULT NULL
,  `ip` varchar(20) NOT NULL DEFAULT ''
,  `date` datetime DEFAULT NULL
,  `tel` varchar(10) NOT NULL DEFAULT ''
);
CREATE TABLE `wp_categories` (
  `cat_ID` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `cat_name` varchar(55) NOT NULL DEFAULT ''
,  `category_nicename` varchar(200) NOT NULL DEFAULT ''
,  `category_description` text NOT NULL
,  `category_parent` integer NOT NULL DEFAULT 0
,  UNIQUE (`cat_name`)
);
CREATE TABLE `wp_comments` (
  `comment_ID` integer  NOT NULL PRIMARY KEY AUTOINCREMENT
,  `comment_post_ID` integer NOT NULL DEFAULT 0
,  `comment_author` tinytext NOT NULL
,  `comment_author_email` varchar(100) NOT NULL DEFAULT ''
,  `comment_author_url` varchar(200) NOT NULL DEFAULT ''
,  `comment_author_IP` varchar(100) NOT NULL DEFAULT ''
,  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `comment_content` text NOT NULL
,  `comment_karma` integer NOT NULL DEFAULT 0
,  `comment_approved` text  NOT NULL DEFAULT '1'
,  `user_id` integer NOT NULL DEFAULT 0
);
CREATE TABLE `wp_linkcategories` (
  `cat_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `cat_name` tinytext NOT NULL
,  `auto_toggle` text  NOT NULL DEFAULT 'N'
,  `show_images` text  NOT NULL DEFAULT 'Y'
,  `show_description` text  NOT NULL DEFAULT 'N'
,  `show_rating` text  NOT NULL DEFAULT 'Y'
,  `show_updated` text  NOT NULL DEFAULT 'Y'
,  `sort_order` varchar(64) NOT NULL DEFAULT 'name'
,  `sort_desc` text  NOT NULL DEFAULT 'N'
,  `text_before_link` varchar(128) NOT NULL DEFAULT '<li>'
,  `text_after_link` varchar(128) NOT NULL DEFAULT '<br />'
,  `text_after_all` varchar(128) NOT NULL DEFAULT '</li>'
,  `list_limit` integer NOT NULL DEFAULT -1
);
CREATE TABLE `wp_links` (
  `link_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `link_url` varchar(255) NOT NULL DEFAULT ''
,  `link_name` varchar(255) NOT NULL DEFAULT ''
,  `link_image` varchar(255) NOT NULL DEFAULT ''
,  `link_target` varchar(25) NOT NULL DEFAULT ''
,  `link_category` integer NOT NULL DEFAULT 0
,  `link_description` varchar(255) NOT NULL DEFAULT ''
,  `link_visible` text  NOT NULL DEFAULT 'Y'
,  `link_owner` integer NOT NULL DEFAULT 1
,  `link_rating` integer NOT NULL DEFAULT 0
,  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `link_rel` varchar(255) NOT NULL DEFAULT ''
,  `link_notes` mediumtext NOT NULL
,  `link_rss` varchar(255) NOT NULL DEFAULT ''
);
CREATE TABLE `wp_optiongroup_options` (
  `group_id` integer NOT NULL DEFAULT 0
,  `option_id` integer NOT NULL DEFAULT 0
,  `seq` integer NOT NULL DEFAULT 0
,  PRIMARY KEY (`group_id`,`option_id`)
);
CREATE TABLE `wp_optiongroups` (
  `group_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `group_name` varchar(64) NOT NULL DEFAULT ''
,  `group_desc` varchar(255) DEFAULT NULL
,  `group_longdesc` tinytext DEFAULT NULL
);
CREATE TABLE `wp_options` (
  `option_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `blog_id` integer NOT NULL DEFAULT 0
,  `option_name` varchar(64) NOT NULL DEFAULT ''
,  `option_can_override` text  NOT NULL DEFAULT 'Y'
,  `option_type` integer NOT NULL DEFAULT 1
,  `option_value` text NOT NULL
,  `option_width` integer NOT NULL DEFAULT 20
,  `option_height` integer NOT NULL DEFAULT 8
,  `option_description` tinytext NOT NULL
,  `option_admin_level` integer NOT NULL DEFAULT 1
);
CREATE TABLE `wp_optiontypes` (
  `optiontype_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `optiontype_name` varchar(64) NOT NULL DEFAULT ''
);
CREATE TABLE `wp_optionvalues` (
  `option_id` integer NOT NULL DEFAULT 0
,  `optionvalue` tinytext DEFAULT NULL
,  `optionvalue_desc` varchar(255) DEFAULT NULL
,  `optionvalue_max` integer DEFAULT NULL
,  `optionvalue_min` integer DEFAULT NULL
,  `optionvalue_seq` integer DEFAULT NULL
,  UNIQUE (`option_id`,`optionvalue`)
);
CREATE TABLE `wp_post2cat` (
  `rel_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `post_id` integer NOT NULL DEFAULT 0
,  `category_id` integer NOT NULL DEFAULT 0
);
CREATE TABLE `wp_postmeta` (
  `meta_id` integer NOT NULL PRIMARY KEY AUTOINCREMENT
,  `post_id` integer NOT NULL DEFAULT 0
,  `meta_key` varchar(255) DEFAULT NULL
,  `meta_value` text DEFAULT NULL
);
CREATE TABLE `wp_posts` (
  `ID` integer  NOT NULL PRIMARY KEY AUTOINCREMENT
,  `post_author` integer NOT NULL DEFAULT 0
,  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `post_content` text NOT NULL
,  `post_title` text NOT NULL
,  `post_category` integer NOT NULL DEFAULT 0
,  `post_excerpt` text NOT NULL
,  `post_lat` float DEFAULT NULL
,  `post_lon` float DEFAULT NULL
,  `post_status` text  NOT NULL DEFAULT 'publish'
,  `comment_status` text  NOT NULL DEFAULT 'registered_only'
,  `ping_status` text  NOT NULL DEFAULT 'open'
,  `post_password` varchar(20) NOT NULL DEFAULT ''
,  `post_name` varchar(200) NOT NULL DEFAULT ''
,  `to_ping` text NOT NULL
,  `pinged` text NOT NULL
,  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `post_content_filtered` text NOT NULL
,  `post_parent` integer NOT NULL DEFAULT 0
);
CREATE TABLE `wp_users` (
  `ID` integer  NOT NULL PRIMARY KEY AUTOINCREMENT
,  `user_login` varchar(20) NOT NULL DEFAULT ''
,  `user_pass` varchar(64) NOT NULL DEFAULT ''
,  `user_firstname` varchar(50) NOT NULL DEFAULT ''
,  `user_lastname` varchar(50) NOT NULL DEFAULT ''
,  `user_nickname` varchar(50) NOT NULL DEFAULT ''
,  `user_icq` integer  NOT NULL DEFAULT 0
,  `user_email` varchar(100) NOT NULL DEFAULT ''
,  `user_url` varchar(100) NOT NULL DEFAULT ''
,  `user_ip` varchar(15) NOT NULL DEFAULT ''
,  `user_domain` varchar(200) NOT NULL DEFAULT ''
,  `user_browser` varchar(200) NOT NULL DEFAULT ''
,  `dateYMDhour` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
,  `user_level` integer  NOT NULL DEFAULT 0
,  `user_aim` varchar(50) NOT NULL DEFAULT ''
,  `user_msn` varchar(100) NOT NULL DEFAULT ''
,  `user_yim` varchar(50) NOT NULL DEFAULT ''
,  `user_idmode` varchar(20) NOT NULL DEFAULT ''
,  `user_description` text NOT NULL
,  `user_activation_key` varchar(60) NOT NULL DEFAULT ''
,  `user_status` integer NOT NULL DEFAULT 0
,  `user_nicename` varchar(50) NOT NULL DEFAULT ''
,  UNIQUE (`user_login`)
);
CREATE INDEX "idx_pgv_names_name_gid" ON "pgv_names" (`n_gid`);
CREATE INDEX "idx_pgv_names_name_name" ON "pgv_names" (`n_name`);
CREATE INDEX "idx_pgv_names_name_letter" ON "pgv_names" (`n_letter`);
CREATE INDEX "idx_pgv_names_name_type" ON "pgv_names" (`n_type`);
CREATE INDEX "idx_pgv_names_name_surn" ON "pgv_names" (`n_surname`);
CREATE INDEX "idx_addressbook_birthday" ON "addressbook" (`birthday`);
CREATE INDEX "idx_wp_post2cat_post_id" ON "wp_post2cat" (`post_id`,`category_id`);
CREATE INDEX "idx_wp_postmeta_post_id" ON "wp_postmeta" (`post_id`);
CREATE INDEX "idx_wp_postmeta_meta_key" ON "wp_postmeta" (`meta_key`);
CREATE INDEX "idx_wp_comments_comment_approved" ON "wp_comments" (`comment_approved`);
CREATE INDEX "idx_wp_comments_comment_post_ID" ON "wp_comments" (`comment_post_ID`);
CREATE INDEX "idx_pgv_sources_sour_id" ON "pgv_sources" (`s_id`);
CREATE INDEX "idx_pgv_sources_sour_name" ON "pgv_sources" (`s_name`);
CREATE INDEX "idx_pgv_sources_sour_file" ON "pgv_sources" (`s_file`);
CREATE INDEX "idx_pgv_families_fam_id" ON "pgv_families" (`f_id`);
CREATE INDEX "idx_pgv_families_fam_file" ON "pgv_families" (`f_file`);
CREATE INDEX "idx_pgv_individuals_indi_id" ON "pgv_individuals" (`i_id`);
CREATE INDEX "idx_pgv_individuals_indi_name" ON "pgv_individuals" (`i_name`);
CREATE INDEX "idx_pgv_individuals_indi_letter" ON "pgv_individuals" (`i_letter`);
CREATE INDEX "idx_pgv_individuals_indi_file" ON "pgv_individuals" (`i_file`);
CREATE INDEX "idx_pgv_individuals_indi_surn" ON "pgv_individuals" (`i_surname`);
CREATE INDEX "idx_wp_optionvalues_option_id_2" ON "wp_optionvalues" (`option_id`,`optionvalue_seq`);
CREATE INDEX "idx_wp_links_link_category" ON "wp_links" (`link_category`);
CREATE INDEX "idx_wp_links_link_visible" ON "wp_links" (`link_visible`);
CREATE INDEX "idx_wp_categories_category_nicename" ON "wp_categories" (`category_nicename`);
CREATE INDEX "idx_pgv_other_other_id" ON "pgv_other" (`o_id`);
CREATE INDEX "idx_pgv_other_other_file" ON "pgv_other" (`o_file`);
CREATE INDEX "idx_tresors_categorie" ON "tresors" (`categorie`);
CREATE INDEX "idx_pgv_places_place_place" ON "pgv_places" (`p_place`);
CREATE INDEX "idx_pgv_places_place_level" ON "pgv_places" (`p_level`);
CREATE INDEX "idx_pgv_places_place_parent" ON "pgv_places" (`p_parent_id`);
CREATE INDEX "idx_pgv_places_place_file" ON "pgv_places" (`p_file`);
CREATE INDEX "idx_wp_posts_post_date" ON "wp_posts" (`post_date`);
CREATE INDEX "idx_wp_posts_post_date_gmt" ON "wp_posts" (`post_date_gmt`);
CREATE INDEX "idx_wp_posts_post_name" ON "wp_posts" (`post_name`);
CREATE INDEX "idx_wp_posts_post_status" ON "wp_posts" (`post_status`);
CREATE INDEX "idx_pgv_placelinks_plindex_place" ON "pgv_placelinks" (`pl_p_id`);
CREATE INDEX "idx_pgv_placelinks_plindex_gid" ON "pgv_placelinks" (`pl_gid`);
CREATE INDEX "idx_pgv_placelinks_plindex_file" ON "pgv_placelinks" (`pl_file`);
