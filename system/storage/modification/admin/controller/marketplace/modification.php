<?php
/**
 * Modifcation XML Documentation can be found here:
 *
 * https://github.com/opencart/opencart/wiki/Modification-System
 */
class ControllerMarketplaceModification extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('marketplace/modification');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

		$this->getList();
	}

    public function edit() {
        $this->load->language('marketplace/modification');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $modification = $this->model_extension_module_modification_manager->getModification($this->request->get['modification_id']);

            if ($modification) {
                $this->model_extension_module_modification_manager->addModificationBackup($this->request->get['modification_id'], $modification);
            }

            $this->model_extension_module_modification_manager->editModification($this->request->get['modification_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }



            if (!isset($this->request->get['update'])) {
                $this->response->redirect($this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true));
            } else {
                $this->refresh();
                $this->response->redirect($this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'] . $url, true));
            }
        }

        $this->getForm();
    }

    public function restore() {
        $this->load->language('marketplace/extension');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

        if (isset($this->request->get['modification_id']) AND isset($this->request->get['backup_id'])) {

            $backup = $this->model_extension_module_modification_manager->getModificationBackup($this->request->get['modification_id'],$this->request->get['backup_id']);

            $url = '';

            if ($backup) {
                $this->model_extension_module_modification_manager->setModificationRestore($this->request->get['modification_id'], $backup['xml']);
                $this->refresh();
                $this->response->redirect($this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'] . $url, true));
            } else {
                $this->response->redirect($this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'] . $url, true));
            }
        }

        $this->getForm();
    }

    public function clearHistory() {

        // Check user has permission
        if (!$this->user->hasPermission('modify', 'marketplace/modification')) {
            $json['error'] = $this->language->get('error_permission');
        }

        $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			
        $this->model_extension_module_modification_manager->deleteModificationBackups($this->request->get['modification_id']);

        $this->response->redirect($this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'], true));
    }

    public function download() {
        $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

        $modification = $this->model_extension_module_modification_manager->getModification($this->request->get['modification_id']);

        if ($modification) {
            $xml = $modification['xml'];
        } else  {
            $xml = '';
        }

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($xml);
    }

    public function upload() {
        $this->load->language('marketplace/installer');

        $json = array();

        // Check user has permission
        if (!$this->user->hasPermission('modify', 'marketplace/modification')) {
            $json['error'] = $this->language->get('error_permission');
        }

        $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

        $modification = $this->model_extension_module_modification_manager->getModification($this->request->get['modification_id']);

        if (!$json) {
            if (!empty($this->request->files['file']['name'])) {
                if (!$this->request->files['file']['name'] == $modification['code'].".ocmod.xml") {
                    $json['error'] = $this->language->get('error_filetype');
                }

                if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                    $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
                }
            } else {
                $json['error'] = $this->language->get('error_upload');
            }
        }

        if (!$json) {
            // If no temp directory exists create it
            $path = 'temp-' . token(32);

            if (!is_dir(DIR_UPLOAD . $path)) {
                mkdir(DIR_UPLOAD . $path, 0777);
            }

            // Set the steps required for installation
            $json['step'] = array();
            $json['overwrite'] = array();

            if (strrchr($this->request->files['file']['name'], '.') == '.xml') {
                $file = DIR_UPLOAD . $path . '/install.xml';

                // If xml file copy it to the temporary directory
                move_uploaded_file($this->request->files['file']['tmp_name'], $file);

                if (file_exists($file)) {
                    $json['step'][] = array(
                        'text' => $this->language->get('text_xml'),
                        'url'  => str_replace('&amp;', '&', $this->url->link('marketplace/modification/xml', 'user_token=' . $this->session->data['user_token']."&modification_id=".$modification['modification_id'], true)),
                        'path' => $path
                    );

                    // Clear temporary files
                    $json['step'][] = array(
                        'text' => $this->language->get('text_remove'),
                        'url'  => str_replace('&amp;', '&', $this->url->link('marketplace/modification/remove', 'user_token=' . $this->session->data['user_token']."&modification_id=".$modification['modification_id'], true)),
                        'path' => $path
                    );
                } else {
                    $json['error'] = $this->language->get('error_file');
                }
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function xml() {
        $this->load->language('marketplace/installer');

        $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

        $modification = $this->model_extension_module_modification_manager->getModification($this->request->get['modification_id']);

        $json = array();

        if (!$this->user->hasPermission('modify', 'marketplace/modification')) {
            $json['error'] = $this->language->get('error_permission');
        }

        $file = DIR_UPLOAD . $this->request->post['path'] . '/install.xml';

        if (!is_file($file) || substr(str_replace('\\', '/', realpath($file)), 0, strlen(DIR_UPLOAD)) != DIR_UPLOAD) {
            $json['error'] = $this->language->get('error_file');
        }

        if (!$json) {
            $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

            // If xml file just put it straight into the DB
            $xml = file_get_contents($file);

            if ($xml) {
                try {
                    $dom = new DOMDocument('1.0', 'UTF-8');
                    $dom->loadXml($xml);

                    $name = $dom->getElementsByTagName('name')->item(0);

                    if ($name) {
                        $name = $name->nodeValue;
                    } else {
                        $name = '';
                    }

                    $code = $dom->getElementsByTagName('code')->item(0);

                    if (!$code) {
                        $json['error'] = $this->language->get('error_code');
                    }

                    $author = $dom->getElementsByTagName('author')->item(0);

                    if ($author) {
                        $author = $author->nodeValue;
                    } else {
                        $author = '';
                    }

                    $version = $dom->getElementsByTagName('version')->item(0);

                    if ($version) {
                        $version = $version->nodeValue;
                    } else {
                        $version = '';
                    }

                    $link = $dom->getElementsByTagName('link')->item(0);

                    if ($link) {
                        $link = $link->nodeValue;
                    } else {
                        $link = '';
                    }

                    $modification_data = array(
                        'name'    => $name,
                        'code'    => $code,
                        'author'  => $author,
                        'version' => $version,
                        'link'    => $link,
                        'xml'     => $xml,
                        'status'  => 1
                    );

                    if (!$json) {
                        $this->model_extension_module_modification_manager->editModification($modification['modification_id'], $modification_data);
                    }
                } catch(Exception $exception) {
                    $json['error'] = sprintf($this->language->get('error_exception'), $exception->getCode(), $exception->getMessage(), $exception->getFile(), $exception->getLine());
                }
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function remove() {
        $this->load->language('marketplace/modification');

        $json = array();

        if (!$this->user->hasPermission('modify', 'marketplace/modification')) {
            $json['error'] = $this->language->get('error_permission');
        }

        $directory = DIR_UPLOAD . $this->request->post['path'];

        if (!is_dir($directory) || substr(str_replace('\\', '/', realpath($directory)), 0, strlen(DIR_UPLOAD)) != DIR_UPLOAD) {
            $json['error'] = $this->language->get('error_directory');
        }

        if (!$json) {
            // Get a list of files ready to upload
            $files = array();

            $path = array($directory);

            while (count($path) != 0) {
                $next = array_shift($path);

                // We have to use scandir function because glob will not pick up dot files.
                foreach (array_diff(scandir($next), array('.', '..')) as $file) {
                    $file = $next . '/' . $file;

                    if (is_dir($file)) {
                        $path[] = $file;
                    }

                    $files[] = $file;
                }
            }

            rsort($files);

            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);

                } elseif (is_dir($file)) {
                    rmdir($file);
                }
            }

            if (file_exists($directory)) {
                rmdir($directory);
            }

            $json['success'] = $this->language->get('text_success');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }


	public function delete() {
		$this->load->language('marketplace/modification');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

		if (isset($this->request->post['selected']) && $this->validate()) {
			foreach ($this->request->post['selected'] as $modification_id) {
				$this->model_extension_module_modification_manager->deleteModification($modification_id);
                $this->model_extension_module_modification_manager->deleteModificationBackups($modification_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function refresh($data = array()) {
		$this->load->language('marketplace/modification');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			
        $this->load->model('design/theme');

		if ($this->validate()) {
				$error_log = array();

			// Clear vqmod cache
			$vqmod_path = substr(DIR_SYSTEM, 0, -7) . 'vqmod/';

			if (file_exists($vqmod_path)) {
				$vqmod_cache = glob($vqmod_path.'vqcache/vq*');

				if ($vqmod_cache) {
					foreach ($vqmod_cache as $file) {
						if (file_exists($file)) {
							@unlink($file);
						}
					}
				}

				if (file_exists($vqmod_path.'mods.cache')) {
					@unlink($vqmod_path.'mods.cache');
				}

				if (file_exists($vqmod_path.'checked.cache')) {
					@unlink($vqmod_path.'checked.cache');
				}
			}

			// Clear log before refresh modifications
			$handle = fopen(DIR_LOGS . 'ocmod.log', 'w+');
      		fclose($handle);			
				$handle = fopen(DIR_LOGS . 'ocmod_error.log', 'w+');
			fclose($handle);

			// Just before files are deleted, if config settings say maintenance mode is off then turn it on
			$maintenance = $this->config->get('config_maintenance');

			// Clear logs on refresh
			$handle = fopen(DIR_LOGS . 'ocmod.log', 'w+');
			fclose($handle);

			$handle = fopen(DIR_LOGS . 'ocmod_error.log', 'w+');
			fclose($handle);
			
			// Clear twig cache on refresh
			$directories = glob(DIR_CACHE . '*', GLOB_ONLYDIR);

			if ($directories) {
				foreach ($directories as $directory) {
					$files = glob($directory . '/*');
					
					foreach ($files as $file) { 
						if (is_file($file)) {
							unlink($file);
						}
					}
					
					if (is_dir($directory)) {
						rmdir($directory);
					}
				}
			}


			$this->load->model('setting/setting');

			$this->model_setting_setting->editSettingValue('config', 'config_maintenance', true);

			//Log
			$log = array();

			// Clear all modification files
			$files = array();

			// Make path into an array
			$path = array(DIR_MODIFICATION . '*');

			// While the path array is still populated keep looping through
			while (count($path) != 0) {
				$next = array_shift($path);

				foreach (glob($next) as $file) {
					// If directory add to path array
					if (is_dir($file)) {
						$path[] = $file . '/*';
					}

					// Add the file to the files to be deleted array
					$files[] = $file;
				}
			}

			// Reverse sort the file array
			rsort($files);

			// Clear all modification files
			foreach ($files as $file) {
				if ($file != DIR_MODIFICATION . 'index.html') {
					// If file just delete
					if (is_file($file)) {
						unlink($file);

					// If directory use the remove directory function
					} elseif (is_dir($file)) {
						rmdir($file);
					}
				}
			}

			// Begin
			$xml = array();

			// Load the default modification XML
			$xml[] = file_get_contents(DIR_SYSTEM . 'modification.xml');

			// This is purly for developers so they can run mods directly and have them run without upload after each change.
			$files = glob(DIR_SYSTEM . '*.ocmod.xml');

			if ($files) {
				foreach ($files as $file) {
					$xml[] = file_get_contents($file);
				}
			}

			// Get the default modification file
			$filter = array();
		$filter['sort'] = 'name';
		$filter['order'] = 'ASC';

		$results = $this->model_extension_module_modification_manager->getModifications($filter);

			foreach ($results as $result) {
				if ($result['status']) {
					$xml[] = $result['xml'];
				}
			}

			$modification = array();

			foreach ($xml as $xml) {
				if (empty($xml)){
					continue;
				}

				$dom = new DOMDocument('1.0', 'UTF-8');
				$dom->preserveWhiteSpace = false;
				$dom->loadXml($xml);

				// Log
				$log[] = 'MOD: ' . $dom->getElementsByTagName('name')->item(0)->textContent;
				$error_log_mod = 'MOD: ' . $dom->getElementsByTagName('name')->item(0)->textContent;


				// Wipe the past modification store in the backup array
				$recovery = array();

				// Set the a recovery of the modification code in case we need to use it if an abort attribute is used.
				if (isset($modification)) {
					$recovery = $modification;
				}

                if ($this->config->get('config_theme') == 'default') {
                    $theme = $this->config->get('theme_default_directory');
                } else {
                    $theme = $this->config->get('config_theme');
                }

                $store_id = (int)$this->config->get('config_store_id');

				$files = $dom->getElementsByTagName('modification')->item(0)->getElementsByTagName('file');

				foreach ($files as $file) {
					$operations = $file->getElementsByTagName('operation');
				
					$file_error = $file->getAttribute('error');

					$files = explode('|', str_replace("\\", '/', $file->getAttribute('path')));

					foreach ($files as $file) {
						$path = '';

						// Get the full path of the files that are going to be used for modification
						if ((substr($file, 0, 7) == 'catalog')) {
							$path = DIR_CATALOG . substr($file, 8);
						}

						if ((substr($file, 0, 5) == 'admin')) {
							$path = DIR_APPLICATION . substr($file, 6);
						}

						if ((substr($file, 0, 6) == 'system')) {
							$path = DIR_SYSTEM . substr($file, 7);
						}

						if ($path) {
							$files = glob($path, GLOB_BRACE);
							if (!$files) {
								if ($file_error != 'skip') {
									$error_log[] = '----------------------------------------------------------------';
									$error_log[] = $error_log_mod;
									$error_log[] = 'MISSING FILE!';
									$error_log[] = $path;									
								}
							}

							if ($files) {
								foreach ($files as $file) {
									// Get the key to be used for the modification cache filename.
									if (substr($file, 0, strlen(DIR_CATALOG)) == DIR_CATALOG) {
										$key = 'catalog/' . substr($file, strlen(DIR_CATALOG));
									}

									if (substr($file, 0, strlen(DIR_APPLICATION)) == DIR_APPLICATION) {
										$key = 'admin/' . substr($file, strlen(DIR_APPLICATION));
									}

									if (substr($file, 0, strlen(DIR_SYSTEM)) == DIR_SYSTEM) {
										$key = 'system/' . substr($file, strlen(DIR_SYSTEM));
									}

									// If file contents is not already in the modification array we need to load it.
									if (!isset($modification[$key])) {

                                        $route = substr(mb_strstr($key, 'template'), 9, -5);

                                        $theme_info = $this->model_design_theme->getTheme($store_id, $theme, $route);

                                        if ($theme_info) {
                                            $content = html_entity_decode($theme_info['code'], ENT_QUOTES, 'UTF-8');
                                        } else {
                                            $content = file_get_contents($file);
                                        }

										$modification[$key] = preg_replace('~\r?\n~', "\n", $content);
										$original[$key] = preg_replace('~\r?\n~', "\n", $content);

										// Log
										$log[] = PHP_EOL . 'FILE: ' . $key;
									}

									foreach ($operations as $operation) {
										$error = $operation->getAttribute('error');

										// Ignoreif
										$ignoreif = $operation->getElementsByTagName('ignoreif')->item(0);

										if ($ignoreif) {
											if ($ignoreif->getAttribute('regex') != 'true') {
												if (strpos($modification[$key], $ignoreif->textContent) !== false) {
													continue;
												}
											} else {
												if (preg_match($ignoreif->textContent, $modification[$key])) {
													continue;
												}
											}
										}

										$status = false;

										// Search and replace
										if ($operation->getElementsByTagName('search')->item(0)->getAttribute('regex') != 'true') {
											// Search
											$search = $operation->getElementsByTagName('search')->item(0)->textContent;
											$trim = $operation->getElementsByTagName('search')->item(0)->getAttribute('trim');
											$index = $operation->getElementsByTagName('search')->item(0)->getAttribute('index');

											// Trim line if no trim attribute is set or is set to true.
											if (!$trim || $trim == 'true') {
												$search = trim($search);
											}

											// Add
											$add = $operation->getElementsByTagName('add')->item(0)->textContent;
											$trim = $operation->getElementsByTagName('add')->item(0)->getAttribute('trim');
											$position = $operation->getElementsByTagName('add')->item(0)->getAttribute('position');
											$offset = $operation->getElementsByTagName('add')->item(0)->getAttribute('offset');

											if ($offset == '') {
												$offset = 0;
											}

											// Trim line if is set to true.
											if ($trim == 'true') {
												$add = trim($add);
											}

											// Log
											$log[] = 'CODE: ' . $search;

											// Check if using indexes
											if ($index !== '') {
												$indexes = explode(',', $index);
											} else {
												$indexes = array();
											}

											// Get all the matches
											$i = 0;

											$lines = explode("\n", $modification[$key]);

											for ($line_id = 0; $line_id < count($lines); $line_id++) {
												$line = $lines[$line_id];

												// Status
												$match = false;

												// Check to see if the line matches the search code.
												if (stripos($line, $search) !== false) {
													// If indexes are not used then just set the found status to true.
													if (!$indexes) {
														$match = true;
													} elseif (in_array($i, $indexes)) {
														$match = true;
													}

													$i++;
												}

												// Now for replacing or adding to the matched elements
												if ($match) {
													switch ($position) {
														default:
														case 'replace':
															$new_lines = explode("\n", $add);

															if ($offset < 0) {
																array_splice($lines, $line_id + $offset, abs($offset) + 1, array(str_replace($search, $add, $line)));

																$line_id -= $offset;
															} else {
																array_splice($lines, $line_id, $offset + 1, array(str_replace($search, $add, $line)));
															}
															break;
														case 'before':
															$new_lines = explode("\n", $add);

															array_splice($lines, $line_id - $offset, 0, $new_lines);

															$line_id += count($new_lines);
															break;
														case 'after':
															$new_lines = explode("\n", $add);

															array_splice($lines, ($line_id + 1) + $offset, 0, $new_lines);

															$line_id += count($new_lines);
															break;
													}

													// Log
													$log[] = 'LINE: ' . $line_id;

													$status = true;
												}
											}

											$modification[$key] = implode("\n", $lines);
										} else {
											$search = trim($operation->getElementsByTagName('search')->item(0)->textContent);
											$limit = $operation->getElementsByTagName('search')->item(0)->getAttribute('limit');
											$replace = trim($operation->getElementsByTagName('add')->item(0)->textContent);

											// Limit
											if (!$limit) {
												$limit = -1;
											}

											// Log
											$match = array();

											preg_match_all($search, $modification[$key], $match, PREG_OFFSET_CAPTURE);

											// Remove part of the the result if a limit is set.
											if ($limit > 0) {
												$match[0] = array_slice($match[0], 0, $limit);
											}

											if ($match[0]) {
												$log[] = 'REGEX: ' . $search;

												for ($i = 0; $i < count($match[0]); $i++) {
													$log[] = 'LINE: ' . (substr_count(substr($modification[$key], 0, $match[0][$i][1]), "\n") + 1);
												}

												$status = true;
											}

											// Make the modification
											$modification[$key] = preg_replace($search, $replace, $modification[$key], $limit);
										}

										if (!$status) {
											if ($error != 'skip') {
												$error_log[] = "\n";
												$error_log[] = $error_log_mod;
												$error_log[] = 'NOT FOUND!';
												$error_log[] = 'CODE: ' . $search;
												$error_log[] = 'FILE: ' . $key;
											}
											// Abort applying this modification completely.
											if ($error == 'abort') {
												$modification = $recovery;
												// Log
												$log[] = 'NOT FOUND - ABORTING!';
												break 5;
											}
											// Skip current operation or break
											elseif ($error == 'skip') {
												// Log
												$log[] = 'NOT FOUND - OPERATION SKIPPED!';
												continue;
											}
											// Break current operations
											else {
												// Log
												$log[] = 'NOT FOUND - OPERATIONS ABORTED!';
											 	break;
											}
										}
									}
								}
							}
						}
					}
				}

				// Log
				$log[] = '----------------------------------------------------------------';
			}

			// Log
			$ocmod = new Log('ocmod.log');
			$ocmod->write(implode("\n", $log));

			if ($error_log) {
				$ocmod = new Log('ocmod_error.log');
				$ocmod->write(implode("\n", $error_log));
			}

			// Write all modification files
			foreach ($modification as $key => $value) {
				// Only create a file if there are changes
				if ($original[$key] != $value) {
					$path = '';

					$directories = explode('/', dirname($key));

					foreach ($directories as $directory) {
						$path = $path . '/' . $directory;

						if (!is_dir(DIR_MODIFICATION . $path)) {
							@mkdir(DIR_MODIFICATION . $path, 0777);
						}
					}

					$handle = fopen(DIR_MODIFICATION . $key, 'w');

					fwrite($handle, $value);

					fclose($handle);
				}
			}

			// Maintance mode back to original settings
			$this->model_setting_setting->editSettingValue('config', 'config_maintenance', $maintenance);

			// Do not return success message if refresh() was called with $data
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

$url = $this->getListUrlParams();

			if (!empty($data['redirect'])) {
				$redirect = $data['redirect'];
			} elseif (!empty($this->request->get['redirect'])) {
				$redirect = $this->request->get['redirect'];
			} else {
				$redirect = 'marketplace/modification';
			}
			
			//$this->response->redirect($this->url->link($redirect, 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function clear() {
		$this->load->language('marketplace/modification');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

		if ($this->validate()) {
			$files = array();

			// Make path into an array
			$path = array(DIR_MODIFICATION . '*');

			// While the path array is still populated keep looping through
			while (count($path) != 0) {
				$next = array_shift($path);

				foreach (glob($next) as $file) {
					// If directory add to path array
					if (is_dir($file)) {
						$path[] = $file . '/*';
					}

					// Add the file to the files to be deleted array
					$files[] = $file;
				}
			}

			// Reverse sort the file array
			rsort($files);

			// Clear all modification files
			foreach ($files as $file) {
				if ($file != DIR_MODIFICATION . 'index.html') {
					// If file just delete
					if (is_file($file)) {
						unlink($file);

					// If directory use the remove directory function
					} elseif (is_dir($file)) {
						rmdir($file);
					}
				}
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function enable() {
		$this->load->language('marketplace/modification');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

		if (isset($this->request->get['modification_id']) && $this->validate()) {
			$this->model_extension_module_modification_manager->enableModification($this->request->get['modification_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function disable() {
		$this->load->language('marketplace/modification');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

		if (isset($this->request->get['modification_id']) && $this->validate()) {
			$this->model_extension_module_modification_manager->disableModification($this->request->get['modification_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function clearlog() {
		$this->load->language('marketplace/modification');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

		if ($this->validate()) {
			$handle = fopen(DIR_LOGS . 'ocmod.log', 'w+');

			fclose($handle);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'date_modified';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

      	$this->load->model('extension/module/modification_manager');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

      	if (isset($this->request->get['filter_xml'])) {
			$filter_xml = $this->request->get['filter_xml'];
		} else {
			$filter_xml = null;
		}

		if (isset($this->request->get['filter_author'])) {
			$filter_author = $this->request->get['filter_author'];
		} else {
			$filter_author = null;
		}

		$url = $this->getListUrlParams();

		$data['add'] = $this->url->link('marketplace/modification/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['filter_name'] = $filter_name;
		$data['filter_author'] = $filter_author;
		$data['filter_xml'] = $filter_xml;

		$data['modified_files'] = array();

		$modified_files = self::modifiedFiles(DIR_MODIFICATION);

		$filter = array();
		$filter['sort'] = 'name';
		$filter['order'] = 'ASC';
		
		$modification_files = $this->getModificationXmlFiles($filter);

		foreach($modified_files as $modified_file) {
			if(isset($modification_files[$modified_file])){
				$modifications = $modification_files[$modified_file];
			} else {
				$modifications = array();
			}

			$data['modified_files'][] = array(
				'file' => $modified_file,
				'modifications' => $modifications
			);
		}

		// Error log
		$error_file = DIR_LOGS . 'ocmod_error.log';

		if (file_exists($error_file)) {
			$data['error_log'] = htmlentities(file_get_contents($error_file, FILE_USE_INCLUDE_PATH, null));
		} else {
			$data['error_log'] = '';
		}
		
		$data['clear_log'] = $this->url->link('marketplace/modification/clearlog', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['filter_action'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'], true);
		$data['reset_url'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'], true);

		$data['tab_files'] = $this->language->get('tab_files');
		$data['tab_error'] = $this->language->get('tab_error');
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['refresh'] = $this->url->link('marketplace/modification/refresh', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['clear'] = $this->url->link('marketplace/modification/clear', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('marketplace/modification/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['modifications'] = array();

		$filter_data = array(
      	'filter_name'	  => $filter_name,
			'filter_author'	  => $filter_author,
			'filter_xml'	  => $filter_xml,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$modification_total = $this->model_extension_module_modification_manager->getTotalModifications($filter_data);

		$results = $this->model_extension_module_modification_manager->getModifications($filter_data);

		foreach ($results as $result) {
			$data['modifications'][] = array(
				'date_modified'      => $result['date_modified'] && $result['date_modified'] != '0000-00-00 00:00:00' ? date(date('Ymd') == date('Ymd', strtotime($result['date_modified'])) ? 'G:i' : $this->language->get('date_format_short'), strtotime($result['date_modified'])) : date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'			     => $this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $result['modification_id'] . $url, true),
				'modification_id' => $result['modification_id'],
				'name'            => $result['name'],
				'author'          => $result['author'],
                'filename'        => $result['code'].".ocmod.xml",
				'version'         => $result['version'],
				'status'          => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'date_added'      => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'link'            => $result['link'],
                'edit'            => $this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $result['modification_id'], true),
                'download'        => $this->url->link('marketplace/modification/download', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $result['modification_id'], true),
                'enable'          => $this->url->link('marketplace/modification/enable', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $result['modification_id'], true),
				'disable'         => $this->url->link('marketplace/modification/disable', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $result['modification_id'], true),
				'enabled'         => $result['status']
			);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

      	if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_xml'])) {
			$url .= '&filter_xml=' . urlencode(html_entity_decode($this->request->get['filter_xml'], ENT_QUOTES, 'UTF-8'));
		}

		$data['sort_date_modified'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . '&sort=date_modified' . $url, true);
		$data['sort_name'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url, true);
		$data['sort_author'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . '&sort=author' . $url, true);
		$data['sort_version'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . '&sort=version' . $url, true);
		$data['sort_status'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . '&sort=status' . $url, true);
		$data['sort_date_added'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . '&sort=date_added' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

      	if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_xml'])) {
			$url .= '&filter_xml=' . urlencode(html_entity_decode($this->request->get['filter_xml'], ENT_QUOTES, 'UTF-8'));
		}
		$pagination = new Pagination();
		$pagination->total = $modification_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($modification_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($modification_total - $this->config->get('config_limit_admin'))) ? $modification_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $modification_total, ceil($modification_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		// Log
		$file = DIR_LOGS . 'ocmod.log';

		if (file_exists($file)) {
			$data['log'] = htmlentities(file_get_contents($file, FILE_USE_INCLUDE_PATH, null));
		} else {
			$data['log'] = '';
		}

		$data['clear_log'] = $this->url->link('marketplace/modification/clearlog', 'user_token=' . $this->session->data['user_token'], true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/modification_manager/list', $data));
	}

    protected function getForm() {

        $this->load->language('marketplace/modification');

        $this->document->addStyle('view/javascript/codemirror/lib/codemirror.css');
        $this->document->addStyle('view/javascript/codemirror/theme/xq-dark.css');
        $this->document->addScript('view/javascript/codemirror/lib/codemirror.js');
        $this->document->addScript('view/javascript/codemirror/lib/xml.js');
        $this->document->addScript('view/javascript/codemirror/lib/formatting.js');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_form'] = $this->language->get('text_form');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_xml'] = $this->language->get('entry_xml');

        $data['column_id'] = $this->language->get('column_id');
        $data['column_code'] = $this->language->get('column_code');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_restore'] = $this->language->get('column_restore');

        $data['button_update'] = $this->language->get('button_update');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_restore'] = $this->language->get('button_restore');
        $data['button_history'] = $this->language->get('button_history');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_backup'] = $this->language->get('tab_backup');

        $data['user_token'] = $this->session->data['user_token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $url = '';

        if (!isset($this->request->get['modification_id'])) {
            $data['action'] = $this->url->link('marketplace/modification/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'] . $url, true);
        }

        $data['restore'] = $this->url->link('marketplace/modification/restore', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'] . $url, true);
        $data['history'] = $this->url->link('marketplace/modification/clearhistory', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'] . $url, true);
        $data['cancel'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true);

        $this->load->model('setting/modification');
		$this->load->model('extension/module/modification_manager');
			

        $backups = $this->model_extension_module_modification_manager->getModificationBackups($this->request->get['modification_id']);

        $data['backups'] = array();

        if ($backups) {
            foreach ($backups as $backup) {
                $data['backups'][] = array(
                    'backup_id'     => $backup['backup_id'],
                    'code'          => $backup['code'],
                    'date_added'    => $backup['date_added'],
                    'restore'       => $this->url->link('marketplace/modification/restore', 'user_token=' . $this->session->data['user_token'] . '&modification_id=' . $this->request->get['modification_id'] . '&backup_id=' . $backup['backup_id'] . $url, true)
                );
            }
        }

        $modification = $this->model_extension_module_modification_manager->getModification($this->request->get['modification_id']);

        if (isset($this->request->post['name'])) {
            $data['name'] = htmlentities(ltrim($this->request->post['name']));
        } elseif (isset($modification)) {
            $data['name'] = htmlentities(ltrim($modification['name']));
        }

        if (isset($this->request->post['xml'])) {
            $data['xml'] = htmlentities(ltrim($this->request->post['xml'], "﻿"));
        } elseif (isset($modification)) {
            $data['xml'] = htmlentities(ltrim($modification['xml'], "﻿"));
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('marketplace/modification_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'marketplace/modification')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 2)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
	}



public function add() {
		$this->load->language('marketplace/modification');

		$this->load->model('extension/module/modification_manager');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$xml = html_entity_decode($this->request->post['xml'], ENT_QUOTES, 'UTF-8');

			$dom = new DOMDocument('1.0', 'UTF-8');
			$dom->preserveWhiteSpace = false;
			$dom->loadXml($xml);

			$data = array(
				'version' => '',
				'author' => '',
				'link' => '',
				'status' => 1
			);

			$data['xml'] = $xml;

			$data['name'] = $dom->getElementsByTagName('name')->item(0)->textContent;

			$data['code'] = $dom->getElementsByTagName('code')->item(0)->textContent;

			if ($dom->getElementsByTagName('version')->length) {
				$data['version'] = $dom->getElementsByTagName('version')->item(0)->textContent;
			}

			if ($dom->getElementsByTagName('author')->length) {
				$data['author'] = $dom->getElementsByTagName('author')->item(0)->textContent;
			}

			$this->model_extension_module_modification_manager->addModification($data);

			$modification_id = $this->db->getLastId();

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . $this->getListUrlParams(array('modification_id' => $modification_id)), true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('marketplace/modification');

		$this->load->model('extension/module/modification_manager');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !empty($this->request->get['modification_id']) && $this->validateForm()) {
			$xml = html_entity_decode(rawurldecode($this->request->post['xml']), ENT_QUOTES, 'UTF-8');

			$dom = new DOMDocument('1.0', 'UTF-8');
			$dom->preserveWhiteSpace = false;
			$dom->loadXml($xml);

			$data = array();

			$data['xml'] = $xml;

			$data['name'] = $dom->getElementsByTagName('name')->item(0)->textContent;

			$data['code'] = $dom->getElementsByTagName('code')->item(0)->textContent;

			if ($dom->getElementsByTagName('version')->length) {
				$data['version'] = $dom->getElementsByTagName('version')->item(0)->textContent;
			} else {
				$data['version'] = '';
			}

			if ($dom->getElementsByTagName('author')->length) {
				$data['author'] = $dom->getElementsByTagName('author')->item(0)->textContent;
			} else {
				$data['author'] = '';
			}

			if ($dom->getElementsByTagName('link')->length) {
				$data['link'] = $dom->getElementsByTagName('link')->item(0)->textContent;
			} else {
				$data['link'] = '';
			}

			$this->model_extension_module_modification_manager->editModification($this->request->get['modification_id'], $data);

			$url = $this->getListUrlParams(array('modification_id' => $this->request->get['modification_id']));

			if (isset($this->request->get['refresh'])) {
				$this->response->redirect($this->url->link('marketplace/modification/refresh', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}

			if ($this->db->countAffected()) {
				$this->session->data['success'] = $this->language->get('text_success');

				$this->response->redirect($this->url->link('marketplace/modification/edit', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
		}

		$this->getForm();
	}

	public function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_refresh'] = $this->language->get('button_refresh');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} elseif (!empty($this->error)) {
			$data['error_warning'] = $this->language->get('error_warning');
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = false;
		}

		if (isset($this->error['xml'])) {
			$data['error_xml'] = $this->error['xml'];
		}
		
		$urlParams = array();
		
		if (isset($this->request->get['modification_id'])) {
			$urlParams['modification_id'] = $this->request->get['modification_id'];
		}

		$url = $this->getListUrlParams($urlParams);

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (isset($this->request->get['modification_id'])) {
			$this->load->model('extension/module/modification_manager');

			$modification_info = $this->model_extension_module_modification_manager->getModification($this->request->get['modification_id']);
			if (!$modification_info) exit;

			$data['text_form'] = sprintf($this->language->get('text_edit'), $modification_info['name']);


			$data['action'] = $this->url->link('marketplace/modification/edit', '&modification_id=' . $modification_info['modification_id'] . '&user_token=' . $this->session->data['user_token'] . $url, true);

			$data['refresh'] = $this->url->link('marketplace/modification/edit', '&modification_id=' . $modification_info['modification_id'] . '&refresh=1&user_token=' . $this->session->data['user_token'] . $url, true);

			$this->document->setTitle($modification_info['name'] . ' » ' . $data['heading_title']);
		} else {
			$data['text_form'] = $this->language->get('text_add');

			$data['refresh'] = false;

			$data['action'] = $this->url->link('marketplace/modification/add', 'user_token=' . $this->session->data['user_token'], true);

			$this->document->setTitle($data['heading_title']);
		}

		$data['cancel'] = $this->url->link('marketplace/modification', 'user_token=' . $this->session->data['user_token'] . $this->getListUrlParams(), true);

		$data['modification'] = array();

		if (!empty($modification_info)) {
			$data['modification']['status'] = $modification_info['status'];
		} else {
			$data['modification']['status'] = 0;
		}

		if (isset($this->request->post['xml'])) {
			$data['modification']['xml'] = html_entity_decode($this->request->post['xml'], ENT_QUOTES, 'UTF-8');
		} elseif (!empty($modification_info)) {
			$data['modification']['xml'] = $modification_info['xml'];
		} else {
			$data['modification']['xml'] = '';
		}

		$this->document->addStyle('view/javascript/codemirror/lib/codemirror.css');
		$this->document->addScript('view/javascript/codemirror/lib/codemirror.js');
		$this->document->addScript('view/javascript/codemirror/mode/xml/xml.js');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/modification_manager/form', $data));
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'marketplace/modification')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$error = false;

		// Required
		if (empty($this->request->post['xml'])) {
			$error = $this->language->get('error_required');
		}

		// 2. Validate XML
		if (!$error) {
			$xml = html_entity_decode(rawurldecode($this->request->post['xml']), ENT_QUOTES, 'UTF-8');

			libxml_use_internal_errors(true);

			$dom = new DOMDocument('1.0', 'UTF-8');

			if(!$dom->loadXml(html_entity_decode($xml, ENT_QUOTES, 'UTF-8'))){

			    foreach (libxml_get_errors() as $error) {
			        $msg = '';

			        switch ($error->level) {
			            case LIBXML_ERR_WARNING :
			                $msg .= "Warning $error->code: ";
			                break;
			            case LIBXML_ERR_ERROR :
			                $msg .= "Error $error->code: ";
			                break;
			            case LIBXML_ERR_FATAL :
			                $msg .= "Fatal Error $error->code: ";
			                break;
			        }

			        $msg .= trim ( $error->message ) . "\nLine: $error->line";

			        $error = $msg;
			    }

			    libxml_clear_errors();
			}

			libxml_use_internal_errors(false);
		}

		// 3. Required tags
		if (!$error && (!$dom->getElementsByTagName('name') || $dom->getElementsByTagName('name')->length == 0 || $dom->getElementsByTagName('name')->item(0)->textContent == '')) {
			$error = $this->language->get('error_name');
		}

		if (!$error && (!$dom->getElementsByTagName('code') || $dom->getElementsByTagName('code')->length == 0 || $dom->getElementsByTagName('code')->item(0)->textContent == '')) {
			$error = $this->language->get('error_code');
		}

		// 4. Check code isn't duplicate
		if (!$error) {
			$code = $dom->getElementsByTagName('code')->item(0)->textContent;

			$this->load->model('extension/module/modification_manager');
			
			$modification_info = $this->model_extension_module_modification_manager->getModificationByCode($code);

			if ($modification_info && (!isset($this->request->get['modification_id']) || $modification_info['modification_id'] != $this->request->get['modification_id'])) {
				$error = sprintf($this->language->get('error_exists'), $modification_info['name'], $modification_info['code']);
			}
		}

		if ($error) {
			$this->error['xml'] = $error;
		}

		return !$this->error;
	}

	static function modifiedFiles($dir, $dirLen = 0) {
		$tree = glob(rtrim($dir, '/') . '/*');
		if (!$dirLen) {
			$dirLen = strlen($dir);
		}
		$files = array();

	    if (is_array($tree)) {
	        foreach($tree as $file) {
	        	if ($file == $dir . 'index.html') {
					continue;
				} elseif (is_file($file)) {
	                $files[] = substr($file, $dirLen);
	            } elseif (is_dir($file)) {
	                $files = array_merge($files, self::modifiedFiles($file, $dirLen));
	            }
	        }
	    }

	    return $files;
	}

	protected function getListUrlParams(array $params = array()) {
		if (isset($params['sort'])) {
			$params['sort'] = $params['sort'];
		} elseif (isset($this->request->get['sort'])) {
			$params['sort'] = $this->request->get['sort'];
		}

		if (isset($params['order'])) {
			$params['order'] = $params['order'];
		} elseif (isset($this->request->get['order'])) {
			$params['order'] = $this->request->get['order'];
		}

		if (isset($params['filter_name'])) {
			$params['filter_name'] = urlencode(html_entity_decode($params['filter_name'], ENT_QUOTES, 'UTF-8'));
		} elseif (isset($this->request->get['filter_name'])) {
			$params['filter_name'] = urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($params['filter_author'])) {
			$params['filter_author'] = urlencode(html_entity_decode($params['filter_author'], ENT_QUOTES, 'UTF-8'));
		} elseif (isset($this->request->get['filter_author'])) {
			$params['filter_author'] = urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($params['filter_xml'])) {
			$params['filter_xml'] = urlencode(html_entity_decode($params['filter_xml'], ENT_QUOTES, 'UTF-8'));
		} elseif (isset($this->request->get['filter_xml'])) {
			$params['filter_xml'] = urlencode(html_entity_decode($this->request->get['filter_xml'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($params['page'])) {
			$params['page'] = $params['page'];
		} elseif (isset($this->request->get['page'])) {
			$params['page'] = $this->request->get['page'];
		}

		$paramsJoined = array();

		foreach($params as $param => $value) {
			$paramsJoined[] = "$param=$value";
		}

		return '&' . implode('&', $paramsJoined);
	}

	protected function getModificationXmlFiles($filter = array()) {
		$return = array();

		$baseLen = strlen(substr(DIR_SYSTEM, 0, -7));

		$xml = array();

		$xml[] = file_get_contents(DIR_SYSTEM . 'modification.xml');

		$files = glob(DIR_SYSTEM . '*.ocmod.xml');

		if ($files) {
			foreach ($files as $file) {
				$xml[] = file_get_contents($file);
			}
		}
		
		$results = $this->model_extension_module_modification_manager->getModifications($filter);

		foreach ($results as $result) {
			if ($result['status']) {
				$xml[] = $result['xml'];
			}
		}

		foreach ($xml as $xml) {
			if (empty($xml)){
				continue;
			}

			$dom = new DOMDocument('1.0', 'UTF-8');
			$dom->preserveWhiteSpace = false;
			$dom->loadXml($xml);

			$files = $dom->getElementsByTagName('modification')->item(0)->getElementsByTagName('file');

			foreach ($files as $file) {
				$operations = $file->getElementsByTagName('operation');

				$file_error = $file->getAttribute('error');

				$files = explode('|', $file->getAttribute('path'));

				foreach ($files as $file) {
					$path = '';

					// Get the full path of the files that are going to be used for modification
					if ((substr($file, 0, 7) == 'catalog')) {
						$path = DIR_CATALOG . substr($file, 8);
					}

					if ((substr($file, 0, 5) == 'admin')) {
						$path = DIR_APPLICATION . substr($file, 6);
					}

					if ((substr($file, 0, 6) == 'system')) {
						$path = DIR_SYSTEM . substr($file, 7);
					}

					if ($path) {
						$files = glob($path, GLOB_BRACE);

						if ($files) {
							foreach ($files as $file) {
								$file = substr($file, $baseLen);

								if (!isset($return[$file])) {
									$return[$file] = array();
								}

								if ($dom->getElementsByTagName('code')->length) {
									$code = $dom->getElementsByTagName('code')->item(0)->textContent;
								} else {
									continue;
								}

								if (!empty($return[$file])) {
									foreach ($return[$file] as $return_file) {
										if ($return_file['code'] == $code) {
											continue 2;
										}
									}
								}

								if ($dom->getElementsByTagName('name')->length) {
									$name = $dom->getElementsByTagName('name')->item(0)->textContent;
								} else {
									continue;
								}

								if ($dom->getElementsByTagName('author')->length) {
									$author = $dom->getElementsByTagName('author')->item(0)->textContent;
								} else {
									$author = '';
								}

								$return[$file][] = array(
									'code' => $code,
									'name' => $name,
									'author' => $author
								);
							}
						}
					}
				}
			}
		}

		return $return;
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'marketplace/modification')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
