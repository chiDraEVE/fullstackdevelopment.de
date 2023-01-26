<?php
	class PortfolioHelper {
		private static $isFictionalUniversity = false;
		private static $projectName;
		
		public static function getIsFictionalUniversity() {
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
			$isFictionalUniversity = false;
			
			$relations = get_field('relations');
			$postType = get_post_type();
			$postTypesOfFictionalUniversity = array("program", "professor", "program", "event", "campus");
			if ($relations && !is_home()) {
				foreach ( $relations as $relation ) {
					$title = get_the_title( $relation );
					if ( str_contains( $title, 'Fictional University' )
					     || str_contains( $title, 'Become a WordPress Developer: Unlocking Power With Code'
					     ) ) {
						$isFictionalUniversity = true;
					}
				}
			}
			if ((in_array($postType, $postTypesOfFictionalUniversity) || has_category('Fictional University'))
			    && !is_home())
				$isFictionalUniversity = true;
			
			if (str_contains(get_the_title(), 'Fictional University'))
				$isFictionalUniversity = true;
			
			if ($isFictionalUniversity) {
				self::$projectName = 'fictional-university';
				require get_theme_file_path('/assets/fictional-university/inc/like-route.php');
				require get_theme_file_path('/assets/fictional-university/inc/search-route.php');
			}
			
			self::$isFictionalUniversity = $isFictionalUniversity;
			return $isFictionalUniversity;
		}
	}