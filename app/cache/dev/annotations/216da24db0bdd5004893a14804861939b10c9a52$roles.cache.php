<?php return unserialize('a:4:{i:0;O:31:"Doctrine\\ORM\\Mapping\\ManyToMany":7:{s:12:"targetEntity";s:4:"Role";s:8:"mappedBy";N;s:10:"inversedBy";N;s:7:"cascade";N;s:5:"fetch";s:4:"LAZY";s:13:"orphanRemoval";b:0;s:7:"indexBy";N;}i:1;O:30:"Doctrine\\ORM\\Mapping\\JoinTable":4:{s:4:"name";s:20:"oro_user_access_role";s:6:"schema";N;s:11:"joinColumns";a:1:{i:0;O:31:"Doctrine\\ORM\\Mapping\\JoinColumn":7:{s:4:"name";s:7:"user_id";s:20:"referencedColumnName";s:2:"id";s:6:"unique";b:0;s:8:"nullable";b:1;s:8:"onDelete";s:7:"CASCADE";s:16:"columnDefinition";N;s:9:"fieldName";N;}}s:18:"inverseJoinColumns";a:1:{i:0;O:31:"Doctrine\\ORM\\Mapping\\JoinColumn":7:{s:4:"name";s:7:"role_id";s:20:"referencedColumnName";s:2:"id";s:6:"unique";b:0;s:8:"nullable";b:1;s:8:"onDelete";s:7:"CASCADE";s:16:"columnDefinition";N;s:9:"fieldName";N;}}}i:2;O:56:"Oro\\Bundle\\DataAuditBundle\\Metadata\\Annotation\\Versioned":1:{s:6:"method";s:8:"getLabel";}i:3;O:61:"Oro\\Bundle\\EntityConfigBundle\\Metadata\\Annotation\\ConfigField":2:{s:4:"mode";s:7:"default";s:13:"defaultValues";a:2:{s:9:"dataaudit";a:1:{s:9:"auditable";b:1;}s:12:"importexport";a:1:{s:8:"excluded";b:1;}}}}');