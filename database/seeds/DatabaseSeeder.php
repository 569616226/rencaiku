<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ExamineTableSeeder::class);
        $this->call(ResumeTableSeeder::class);
        $this->call(SubscribeTableSeeder::class);
        $this->call(SubscribeUsersTableSeeder::class);
        $this->call(AppraiseTableSeeder::class);

        $this->call(NoticesTableSeeder::class);
        $this->call(ArchivesTableSeeder::class);
        $this->call(EducationsTableSeeder::class);
        $this->call(WorksTableSeeder::class);
        $this->call(SanctionsTableSeeder::class);
        $this->call(FamiliesTableSeeder::class);
        $this->call(AgreementsTableSeeder::class);
        $this->call(PromotionsTableSeeder::class);
        $this->call(SalariesTableSeeder::class);
        $this->call(ClosuresTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(ArchvieLogsTableSeeder::class);
        $this->call(WarnsTableSeeder::class);
    }
}
