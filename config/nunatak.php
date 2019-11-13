<?php

$root_domain = env('NUNATAK_ROOT_DOMAIN', 'nunatak.io');

return [
	'root_domain' => $root_domain,
	'domain_suffix' => env('NUNATAK_DOMAIN_SUFFIX', '.'.$root_domain),
];
