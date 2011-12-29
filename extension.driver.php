<?php
	Class extension_commentary_injector extends Extension
	{
		/*-------------------------------------------------------------------------
			Extension definition
		-------------------------------------------------------------------------*/
	
	public function about()
		{
			return array(
				'name' => 'Commentary Injector',
				'version'	=> '0.0.1',
				'author'	=> array('name' => 'IBCICO Development',
									'website' => 'http://ibcico.com/',
									'email' => 'i.zhuravlev@ibcico.com'),
				'release-date' => '2011-12-29',
			);
		}
		
		
		
	public function getSubscribedDelegates()
		{
			return array(
				array(
					'page'		=> '/blueprints/events/new/',
					'delegate'	=> 'AppendEventFilter',
					'callback'	=> 'apendEventFilter'
				),
				array(
					'page'		=> '/blueprints/events/edit/',
					'delegate'	=> 'AppendEventFilter',
					'callback'	=> 'apendEventFilter'
				),
				array(
					'page'		=> '/frontend/',
					'delegate'	=> 'EventPostSaveFilter',
					'callback'	=> 'collect_data'
				),
			);
		}
				
		
	public function apendEventFilter(&$context)
		{
			$context['options'][] = array('commentary-injector', @in_array('commentary-injector', $context['selected']) ,'Commentary Injector');
		}
		
	public function collect_data($context)
		{
			$subsection_id = 104;
			$id = $_POST['fields']['id'];
			$entry_id = $context['entry']->get('id');
			Symphony::Database()->query("INSERT INTO tbl_entries_data_$subsection_id (id, entry_id, relation_id) VALUES (NULL, $id, $entry_id)");
		}
	}