<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2024 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
namespace OC\Core\Migrations;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\DB\Types;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 *
 */
class Version30000Date20240708160048 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		if ($schema->hasTable('taskprocessing_tasks')) {
			$table = $schema->getTable('taskprocessing_tasks');

			$table->addColumn('scheduled_at', Types::INTEGER, [
				'notnull' => false,
				'default' => 0,
				'unsigned' => true,
			]);
			$table->addColumn('started_at', Types::INTEGER, [
				'notnull' => false,
				'default' => 0,
				'unsigned' => true,
			]);
			$table->addColumn('ended_at', Types::INTEGER, [
				'notnull' => false,
				'default' => 0,
				'unsigned' => true,
			]);

			return $schema;
		}

		return null;
	}
}
