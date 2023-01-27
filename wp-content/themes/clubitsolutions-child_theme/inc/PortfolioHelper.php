<?php
	class PortfolioHelper {
		private static $isFictionalUniversity = false;
		private static $projectName;
		
		public static function getIsFictionalUniversity(): bool {
			return PortfolioHelper::$isFictionalUniversity;
		}
		
		public static function setIsFictionalUniversity($isUniversity) {
			PortfolioHelper::$isFictionalUniversity = $isUniversity;
		}
		
		public static function getProjectName() {
			return PortfolioHelper::$projectName;
		}
		
		public static function setProjectName($name) {
			PortfolioHelper::$projectName = $name;
		}
		
		public static function isFictionalUniversity(): bool {
			$relations = get_field('relations');
			$postType = get_post_type();
			$postTypesOfFictionalUniversity = array("program", "professor", "note", "event", "campus");
			
			/**
			 * Checks if a page or post is from fictional university. This is needed to differentiate from real pages and
			 * posts. These are now the only post-types to look out for.
			 */
			if ($relations ) {
				foreach ( $relations as $relation ) {
					$title = get_the_title( $relation );
					if ( str_contains( $title, 'Fictional University' )
					     || str_contains( $title, 'Become a WordPress Developer: Unlocking Power With Code'
					     ) ) {
						self::setIsFictionalUniversity(true);
					}
				}
			}
			
			/**
			 * Checks if it's a custom post type from fictional university
			 * The other conditions in the shouldn't be necessary
			 * There's for example some strange behaviour:
			 * The programs post type gives me the post-type 'program'
			 * But events and campuses don't, but are true for is_post_type_archive($post-type)
			 * Also gives the Query Monitor the correct post type. echo get_post_type() gives an empty string
			 * TODO check for this strange behaviour in a future state of the project. May be this resolves itself
			 */
			if ( in_array($postType, $postTypesOfFictionalUniversity)
				|| has_category('Fictional University')
				|| str_contains(get_the_title(), 'Fictional University')
				|| is_post_type_archive($postTypesOfFictionalUniversity) ) // shouldn't be necassary
				self::setIsFictionalUniversity(true);
			
			if (self::getIsFictionalUniversity()) {
				require get_theme_file_path('/assets/fictional-university/inc/like-route.php');
				require get_theme_file_path('/assets/fictional-university/inc/search-route.php');
			}
			
			return self::getIsFictionalUniversity();
		}
	}