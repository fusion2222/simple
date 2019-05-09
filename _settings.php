<?php

// The poorest reccomended security I ever saw. But let it be here.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

const SIMPLE_PARTNER_LOGOS__CONTENT_TYPE_NAME = 'simple_partner_logo';

const SIMPLE_PARTNER_LOGOS__TAXONOMY = 'simple_partner_logos_categories';

const SIMPLE_PARTNER_LOGOS__TAXONOMY_MAIN_PARTNERS = 'main_partners';
const SIMPLE_PARTNER_LOGOS__TAXONOMY_MAIN_MEDIA_PARTNERS = 'main_media_partners';
const SIMPLE_PARTNER_LOGOS__TAXONOMY_PARTNERS = 'partners';
const SIMPLE_PARTNER_LOGOS__TAXONOMY_MEDIA_PARTNERS = 'media_partners';

const SIMPLE_PARTNER_LOGOS__LOGO_TAXONOMIES = [
	SIMPLE_PARTNER_LOGOS__TAXONOMY_MAIN_PARTNERS,
	SIMPLE_PARTNER_LOGOS__TAXONOMY_MAIN_MEDIA_PARTNERS,
	SIMPLE_PARTNER_LOGOS__TAXONOMY_PARTNERS,
	SIMPLE_PARTNER_LOGOS__TAXONOMY_MEDIA_PARTNERS
];

const SIMPLE_PARTNER_LOGOS__LINK_FIELD_ID = 'simple_partner_logos__link';
const SIMPLE_PARTNER_LOGOS__LINK_METABOX_ID = 'simple_partner_logos__link_metabox';
const SIMPLE_PARTNER_LOGOS__TYPE_NONCE_FIELD_ID = 'simple_partner_logos__nonce';
const SIMPLE_PARTNER_LOGOS__TYPE_NONCE_PROCESS = 'simple_partner_logos__nonce_process';
