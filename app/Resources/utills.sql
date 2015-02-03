USE oro_crm;
# SHOW CREATE TABLE orocrm_task;
#
# CREATE TABLE `orocrm_task` (
#   `id` int(11) NOT NULL AUTO_INCREMENT,
#   `task_priority_name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
#   `owner_id` int(11) DEFAULT NULL,
#   `organization_id` int(11) DEFAULT NULL,
#   `workflow_item_id` int(11) DEFAULT NULL,
#   `workflow_step_id` int(11) DEFAULT NULL,
#   `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
#   `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
#   `due_date` datetime NOT NULL,
#   `createdAt` datetime NOT NULL,
#   `updatedAt` datetime NOT NULL,
#   PRIMARY KEY (`id`),
#   UNIQUE KEY `UNIQ_814DEE3F1023C4EE` (`workflow_item_id`),
#   KEY `IDX_814DEE3FD34C1E8E` (`task_priority_name`),
#   KEY `IDX_814DEE3F7E3C61F9` (`owner_id`),
#   KEY `IDX_814DEE3F32C8A3DE` (`organization_id`),
#   KEY `task_due_date_idx` (`due_date`),
#   KEY `IDX_814DEE3F71FE882C` (`workflow_step_id`),
#   KEY `task_updated_at_idx` (`updatedAt`),
#   CONSTRAINT `FK_814DEE3F1023C4EE` FOREIGN KEY (`workflow_item_id`) REFERENCES `oro_workflow_item` (`id`) ON DELETE SET NULL,
#   CONSTRAINT `FK_814DEE3F71FE882C` FOREIGN KEY (`workflow_step_id`) REFERENCES `oro_workflow_step` (`id`) ON DELETE SET NULL,
#   CONSTRAINT `FK_814DEE3FD34C1E8E` FOREIGN KEY (`task_priority_name`) REFERENCES `orocrm_task_priority` (`name`) ON DELETE SET NULL,
#   CONSTRAINT `fk_orocrm_task_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `oro_organization` (`id`) ON DELETE SET NULL,
#   CONSTRAINT `fk_orocrm_task_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `oro_user` (`id`) ON DELETE SET NULL
# ) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

USE oro_test_crm;


CREATE TABLE ezi_issue_resolution (
  id         INT AUTO_INCREMENT NOT NULL,
  resolution VARCHAR(32)        NOT NULL,
  UNIQUE INDEX ISSUE_RESOLUTION_UNIQ_IDX (resolution),
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;


CREATE TABLE ezi_issue_priority (
  id       INT AUTO_INCREMENT NOT NULL,
  priority VARCHAR(32)        NOT NULL,
  UNIQUE INDEX ISSUE_PRIORITY_UNIQ_IDX (priority),
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;


CREATE TABLE ezi_issue_type (
  id   INT AUTO_INCREMENT NOT NULL,
  type VARCHAR(32)        NOT NULL,
  UNIQUE INDEX ISSUE_TYPE_UNIQ_IDX (type),
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;


CREATE TABLE ezi_issue (
  id                INT AUTO_INCREMENT NOT NULL,
  type_id           INT          DEFAULT NULL,
  priority_id       INT          DEFAULT NULL,
  resolution_id     INT          DEFAULT NULL,
  summary           VARCHAR(255) DEFAULT NULL,
  code              VARCHAR(32)        NOT NULL,
  descripton        VARCHAR(255) DEFAULT NULL,
  status            VARCHAR(32)        NOT NULL,
  tags              VARCHAR(32)        NOT NULL,
  reporter_id       INT                NOT NULL,
  assignee_id       INT                NOT NULL,
  related_issues_id INT          DEFAULT NULL,
  collaborators     INT          DEFAULT NULL,
  parent_id         INT          DEFAULT NULL,
  child_id          INT          DEFAULT NULL,
  workflow_item_id  INT                NOT NULL,
  workflow_step_id  INT                NOT NULL,
  notes             VARCHAR(255) DEFAULT NULL,
  created_at        DATETIME           NOT NULL,
  updated_at        DATETIME           NOT NULL,
  INDEX IDX_D36C0C3AC54C8C93 (type_id),
  INDEX IDX_D36C0C3A497B19F9 (priority_id),
  INDEX IDX_D36C0C3A12A1C43A (resolution_id),
  INDEX EZI_ISSUE_SUMMARY_IDX (summary),
  INDEX EZI_ISSUE_CODE_IDX (code),
  INDEX EZI_ISSUE_DESCRIPTION_IDX (descripton),
  INDEX EZI_ISSUE_STATUS_IDX (status),
  INDEX EZI_ISSUE_REPORTER_ID_IDX (reporter_id),
  INDEX EZI_ISSUE_ASSIGNEE_ID_IDX (assignee_id),
  INDEX EZI_ISSUE_RELATED_ISSUES_ID_IDX (related_issues_id),
  INDEX EZI_ISSUE_COLLABORATORS_ID_IDX (collaborators),
  INDEX EZI_ISSUE_ISSUE_PARENT_ID_IDX (parent_id),
  INDEX EZI_ISSUE_CHILDREN_ID_IDX (child_id),
  INDEX EZI_ISSUE_WORKFLOW_STEP_ID_IDX (workflow_step_id),
  INDEX EZI_ISSUE_NOTES_IDX (notes),
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;


ALTER TABLE ezi_issue ADD CONSTRAINT FK_D36C0C3AC54C8C93 FOREIGN KEY (type_id) REFERENCES ezi_issue_type (id);
ALTER TABLE ezi_issue ADD CONSTRAINT FK_D36C0C3A497B19F9 FOREIGN KEY (priority_id) REFERENCES ezi_issue_priority (id);
ALTER TABLE ezi_issue ADD CONSTRAINT FK_D36C0C3A12A1C43A FOREIGN KEY (resolution_id) REFERENCES ezi_issue_resolution (id);





# ALTER IGNORE TABLE ezi_issue DROP FOREIGN KEY type_id;
# ALTER IGNORE TABLE ezi_issue DROP FOREIGN KEY priority_id;
# ALTER IGNORE TABLE ezi_issue DROP FOREIGN KEY resolution_id;
#
#
# ALTER IGNORE TABLE ezi_issue DROP INDEX IDX_D36C0C3AC54C8C93;
# ALTER IGNORE TABLE ezi_issue DROP INDEX IDX_D36C0C3A497B19F9;
# ALTER IGNORE TABLE ezi_issue DROP INDEX IDX_D36C0C3A12A1C43A;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_SUMMARY_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_CODE_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_DESCRIPTION_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_STATUS_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_REPORTER_ID_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_ASSIGNEE_ID_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_RELATED_ISSUES_ID_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_COLLABORATORS_ID_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_ISSUE_PARENT_ID_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_CHILDREN_ID_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_WORKFLOW_STEP_ID_IDX;
# ALTER IGNORE TABLE ezi_issue DROP INDEX EZI_ISSUE_NOTES_IDX;
#
# DROP TABLE IF EXISTS ezi_issue;
# DROP TABLE IF EXISTS ezi_issue_priority;
# DROP TABLE IF EXISTS ezi_issue_type;
# DROP TABLE IF EXISTS ezi_issue_resolution;