# tyrell_sql_improvement
b. SQL Logic Test

- The provided SQL query seems to be quite complex due to multiple joins and search conditions, which might be affecting its performance. Here are some suggestions for improving the performance of the query:

- Indexing: Ensure that the columns used in the WHERE clause, JOIN conditions, and GROUP BY clause have appropriate indexes. Indexing can significantly speed up the retrieval process.

- Avoiding Wildcard Searches: The LIKE '%value%' pattern can be very slow on large datasets because it requires a full table scan. If possible, avoid using this pattern for searching. If you need to perform text-based searches, consider using a full-text search solution like MySQL's built-in FULLTEXT indexes. The search criteria was flight attendant. It should take one table that related with flight attendant. The jobs table is the best place to search it.

- Pagination: The use of LIMIT and OFFSET can become slower as you move through the result set. Consider using keyset pagination instead, where you track the last retrieved value and use it as a starting point for the next query.

- Reducing JOINs: It looks like there are many left joins that might not be necessary for every query. If some of the data from these joins is not always required, you might consider moving them to subqueries or separate queries to fetch the data when needed. 

- Use EXISTS: In cases where you only need to check for the existence of related data, consider using EXISTS instead of a full join. This can be particularly helpful in cases where a job might have multiple related items (e.g., personalities, skills), and you just need to know if there's any related data.

- Denormalization: Depending on your data access patterns, denormalizing some of the data into the main jobs table could reduce the need for excessive joins.



Written Improve SQL

SELECT Jobs.id AS `Jobs__id`,
Jobs.name AS `Jobs__name`,
Jobs.media_id AS `Jobs__media_id`,
Jobs.job_category_id AS `Jobs__job_category_id`,
Jobs.job_type_id AS `Jobs__job_type_id`,
Jobs.description AS `Jobs__description`,
Jobs.detail AS `Jobs__detail`,
Jobs.business_skill AS `Jobs__business_skill`,
Jobs.knowledge AS `Jobs__knowledge`,
Jobs.location AS `Jobs__location`,
Jobs.activity AS `Jobs__activity`,
Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
Jobs.salary_range_average AS `Jobs__salary_range_average`,
Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
Jobs.restriction AS `Jobs__restriction`,
Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
Jobs.remarks AS `Jobs__remarks`,
Jobs.url AS `Jobs__url`,
Jobs.seo_description AS `Jobs__seo_description`,
Jobs.seo_keywords AS `Jobs__seo_keywords`,
Jobs.sort_order AS `Jobs__sort_order`,
Jobs.publish_status AS `Jobs__publish_status`,
Jobs.version AS `Jobs__version`,
Jobs.created_by AS `Jobs__created_by`,
Jobs.created AS `Jobs__created`,
Jobs.modified AS `Jobs__modified`,
Jobs.deleted AS `Jobs__deleted`,
JobCategories.id AS `JobCategories__id`,
JobCategories.name AS `JobCategories__name`,
JobCategories.sort_order AS `JobCategories__sort_order`,
JobCategories.created_by AS `JobCategories__created_by`,
JobCategories.created AS `JobCategories__created`,
JobCategories.modified AS `JobCategories__modified`,
JobCategories.deleted AS `JobCategories__deleted`,
JobTypes.id AS `JobTypes__id`,
JobTypes.name AS `JobTypes__name`,
JobTypes.job_category_id AS `JobTypes__job_category_id`,
JobTypes.sort_order AS `JobTypes__sort_order`,
JobTypes.created_by AS `JobTypes__created_by`,
JobTypes.created AS `JobTypes__created`,
JobTypes.modified AS `JobTypes__modified`,
JobTypes.deleted AS `JobTypes__deleted`
FROM jobs Jobs
LEFT JOIN jobs_personalities JobsPersonalities
ON Jobs.id = (JobsPersonalities.job_id)
LEFT JOIN personalities Personalities
ON (Personalities.id = (JobsPersonalities.personality_id)
AND (Personalities.deleted) IS NULL)
LEFT JOIN jobs_practical_skills JobsPracticalSkills
ON Jobs.id = (JobsPracticalSkills.job_id)
LEFT JOIN practical_skills PracticalSkills
ON (PracticalSkills.id = (JobsPracticalSkills.practical_skill_id)
AND (PracticalSkills.deleted) IS NULL)
LEFT JOIN jobs_basic_abilities JobsBasicAbilities
ON Jobs.id = (JobsBasicAbilities.job_id)
LEFT JOIN basic_abilities BasicAbilities
ON (BasicAbilities.id = (JobsBasicAbilities.basic_ability_id)
AND (BasicAbilities.deleted) IS NULL)
LEFT JOIN jobs_tools JobsTools
ON Jobs.id = (JobsTools.job_id)
LEFT JOIN affiliates Tools
ON (Tools.type = 1
AND Tools.id = (JobsTools.affiliate_id)
AND (Tools.deleted) IS NULL)
LEFT JOIN jobs_career_paths JobsCareerPaths

ON Jobs.id = (JobsCareerPaths.job_id)
LEFT JOIN affiliates CareerPaths
ON (CareerPaths.type = 3
AND CareerPaths.id = (JobsCareerPaths.affiliate_id)
AND (CareerPaths.deleted) IS NULL)
LEFT JOIN jobs_rec_qualifications JobsRecQualifications
ON Jobs.id = (JobsRecQualifications.job_id)
LEFT JOIN affiliates RecQualifications
ON (RecQualifications.type = 2
AND RecQualifications.id = (JobsRecQualifications.affiliate_id)
AND (RecQualifications.deleted) IS NULL)
LEFT JOIN jobs_req_qualifications JobsReqQualifications
ON Jobs.id = (JobsReqQualifications.job_id)
LEFT JOIN affiliates ReqQualifications
ON (ReqQualifications.type = 2
AND ReqQualifications.id = (JobsReqQualifications.affiliate_id)
AND (ReqQualifications.deleted) IS NULL)
INNER JOIN job_categories JobCategories
ON (JobCategories.id = (Jobs.job_category_id)
AND (JobCategories.deleted) IS NULL)
INNER JOIN job_types JobTypes
ON (JobTypes.id = (Jobs.job_type_id)
AND (JobTypes.deleted) IS NULL)
WHERE 

Jobs.name LIKE '%キャビンアテンダント%'

AND publish_status = 1
AND (Jobs.deleted) IS NULL
GROUP BY Jobs.id
ORDER BY Jobs.sort_order desc,
Jobs.id DESC LIMIT 50 OFFSET 0
