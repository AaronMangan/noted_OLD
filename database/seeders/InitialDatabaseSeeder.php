<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User
        $user = \App\Models\User::create([
            'name' => 'Aaron Mangan',
            'email' => 'azza.mangan@gmail.com',
            'password' => Hash::make('azza.mangan@gmail.com'),
        ]);

        \App\Models\Template::create([
            'name' => 'Simple',
            'template' => $this->entryText(),
            'user_id' => $user->id,
        ]);
    }

    private function entryText(): string
    {
        return '
        # **Using Markdown**

        This guide will help you writing markdown, which is a simple way to write plain text that can be converted to HTML.

        > Try this guide for more information [Markdown Guide](https://www.markdownguide.org/)

        ## Text Styling

        This editor gives you shortcuts to help style your text, but if you want to do it the old fashioned way then:

        | Type          | Syntax                | Example                                                                  |
        | ------------- | --------------------- | ------------------------------------------------------------------------ |
        | Bold          | \*\*Bold\*\*          | **Bold**                                                                 |
        | Italic        | \*Italic\*            | _Italic_                                                                 |
        | Strikethrough | \~\~Strikethrough\~\~ | ~~Striketrough~~                                                         |
        | Blockquote    | \>                    | Unable to example. Place a greater than symbol at the start of each line |

        ## Decorations

        Markdown lets you add several different decorations to your page, for example a horizontal line:

        **Line**

        ---

        **Checkbox**

        -   [ ] Do Something!

        **Code**

        There are two types of code blocks, inline and block. `This is an inline`

        ```
        isThisCool = true;
        if(isThisCool) {
            // Something
        }
        else {
            // Nothing
        }
        ```

        **Lists**

        There are two lists: ordered and unordered:

        -   This is
        -   An unordered list

        Use Numbers to make a ordered list:

        1. First
        2. Second

        ---

        ### **Tables**

        Want a table? We can do that too!!

        | #   | Tip                                        |
        | --- | ------------------------------------------ |
        | 1   | Use pipe symbol to separate cells          |
        | 2   | Sometimes colons can be used for alignment |

        ### **Links**

        Links let you display external or internal resources!

        **Basic Link**
        [Display Text](https://www.markdownguide.org/)

        **Mail Link**
        [Email](mailto:email@anemailaddress.com)
        ';
    }
}
