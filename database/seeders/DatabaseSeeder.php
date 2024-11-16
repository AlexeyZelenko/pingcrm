<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use App\Models\Song; // Подключаем модель Song
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        // Создаем аккаунт для пользователей
//        $account = Account::create(['name' => 'Acme Corporation']);
//
//        // Создаем пользователя-админа
//        User::factory()->create([
//            'account_id' => $account->id,
//            'first_name' => 'John',
//            'last_name' => 'Doe',
//            'email' => 'johndoe@example.com',
//            'password' => bcrypt('secret'),  // Хешируем пароль
//            'owner' => true,
//        ]);
//
//        // Создаем дополнительных пользователей
//        User::factory(5)->create([
//            'account_id' => $account->id,
//            // Генерация уникального email
//            'email' => function () {
//                return 'user' . uniqid() . '@example.com';
//            }
//        ]);
//
//        // Создаем организации
//        $organizations = Organization::factory(100)
//            ->create(['account_id' => $account->id]);
//
//        // Создаем контакты и связываем их с организациями
//        Contact::factory(100)
//            ->create(['account_id' => $account->id])
//            ->each(function ($contact) use ($organizations) {
//                $contact->update(['organization_id' => $organizations->random()->id]);
//            });

        // Добавляем песни на украинском языке про Бога
        $songs = [
            [
                'name' => 'Боже Великий, Єдиний',
                'category' => 'Поклоніння',
                'language' => 'UA',
                'youtube_links' => json_encode(['https://youtube.com/example_link_1']),
                'note' => 'Це одна з найвідоміших українських духовних пісень.',
                'description' => 'Пісня о великій силі та милосерді Бога.',
                'blocks' => json_encode([
                    ['name' => 'Куплет 1', 'content' => 'Боже великий, єдиний, нам Україну храни'],
                    ['name' => 'Приспів', 'content' => 'Дай їй волю, дай їй долю, дай доброго світу']
                ]),
                'seen' => false,
            ],
            [
                'name' => 'Господь є мій пастир',
                'category' => 'Хвала',
                'language' => 'UA',
                'youtube_links' => json_encode(['https://youtube.com/example_link_2']),
                'note' => 'Пісня заснована на Псалмі 23.',
                'description' => 'Пісня о любові і турботі Господа, як пастиря нашої душі.',
                'blocks' => json_encode([
                    ['name' => 'Куплет 1', 'content' => 'Господь є мій пастир, і я не боюсь'],
                    ['name' => 'Приспів', 'content' => 'Він мене провадить стежками добра']
                ]),
                'seen' => false,
            ],
            [
                'name' => 'Боже, до Тебе я кличу',
                'category' => 'Поклоніння',
                'language' => 'UA',
                'youtube_links' => json_encode(['https://youtube.com/example_link_3']),
                'note' => 'Пісня про щирий заклик до Бога.',
                'description' => 'Пісня, яка виражає прагнення бути ближче до Господа.',
                'blocks' => json_encode([
                    ['name' => 'Куплет 1', 'content' => 'Боже, до Тебе я кличу, з милості Своєї почуй'],
                    ['name' => 'Приспів', 'content' => 'Тільки Ти є мій захист, Ти є мій прихисток']
                ]),
                'seen' => false,
            ]
        ];

        // Добавляем песни в базу данных
        foreach ($songs as $songData) {
            Song::create($songData);
        }
    }
}
