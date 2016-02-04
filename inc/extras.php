<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package default
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function default_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    return $classes;
}
add_filter( 'body_class', 'default_body_classes' );

/**
 * Adds custom pagination.
 */
function wp_pagination($pages = '', $range = 9)
{
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base'       => @add_query_arg('page','%#%'),
        'format'     => '',
        'total'      => $wp_query->max_num_pages,
        'current'    => $current,
        'show_all'   => true,
        'prev_text'  => __('<'),
        'next_text'  => __('>'),
        'type'       => 'plain'
    );
    $currentURL = get_pagenum_link(1);
    $explodedLink = explode('/?', $currentURL);
    $singleLink = $explodedLink[0];
    $params = explode('/', $explodedLink[1]);
    if ($wp_rewrite->using_permalinks()) {
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', $singleLink)) . 'page/%#%/', 'paged');
    }
    if (!empty($wp_query->query_vars['s'])) $pagination['add_args'] = array('s' => get_query_var('s'));
    echo '<div class="col-xs-12 wp_pagination">'.paginate_links($pagination).'</div>';
}

/**
 * Thumbnail custom sizes
 */
if (function_exists( 'add_image_size' )) {
    add_image_size('thumb-event-banner', 510, 268, true);
    add_image_size('thumb-catalog-home', 238, 268, array(center, top));
}

/**
 * Minify the HTML to improve page speed
 */
class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
     if (!empty($html))
     {
         $this->parseHTML($html);
     }
    }
    public function __toString()
    {
     return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
     $raw = strlen($raw);
     $compressed = strlen($compressed);

     $savings = ($raw-$compressed) / $raw * 100;

     $savings = round($savings, 2);

     return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
     $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
     preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
     $overriding = false;
     $raw_tag = false;
     // Variable reused for output
     $html = '';
     foreach ($matches as $token)
     {
         $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;

         $content = $token[0];

         if (is_null($tag))
         {
             if ( !empty($token['script']) )
             {
                 $strip = $this->compress_js;
             }
             else if ( !empty($token['style']) )
             {
                 $strip = $this->compress_css;
             }
             else if ($content == '<!--wp-html-compression no compression-->')
             {
                 $overriding = !$overriding;

                 // Don't print the comment
                 continue;
             }
             else if ($this->remove_comments)
             {
                 if (!$overriding && $raw_tag != 'textarea')
                 {
                     // Remove any HTML comments, except MSIE conditional comments
                     $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                 }
             }
         }
         else
         {
             if ($tag == 'pre' || $tag == 'textarea')
             {
                 $raw_tag = $tag;
             }
             else if ($tag == '/pre' || $tag == '/textarea')
             {
                 $raw_tag = false;
             }
             else
             {
                 if ($raw_tag || $overriding)
                 {
                     $strip = false;
                 }
                 else
                 {
                     $strip = true;

                     // Remove any empty attributes, except:
                     // action, alt, content, src
                     $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);

                     // Remove any space before the end of self-closing XHTML tags
                     // JavaScript excluded
                     $content = str_replace(' />', '/>', $content);
                 }
             }
         }

         if ($strip)
         {
             $content = $this->removeWhiteSpace($content);
         }

         $html .= $content;
     }

     return $html;
    }

    public function parseHTML($html)
    {
     $this->html = $this->minifyHTML($html);

     if ($this->info_comment)
     {
         $this->html .= "\n" . $this->bottomComment($html, $this->html);
     }
    }

    protected function removeWhiteSpace($str)
    {
     $str = str_replace("\t", ' ', $str);
     $str = str_replace("\n",  '', $str);
     $str = str_replace("\r",  '', $str);

     while (stristr($str, '  '))
     {
         $str = str_replace('  ', ' ', $str);
     }

     return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');


/**
 * Retorna o src de uma imagem full de um post
 * @param int|string $id
 * @return string
 */

function getUrlSrc($id){
    $url = wp_get_attachment_image_src( get_post_thumbnail_id($id),'full' );
    return $url[0];
}

/**
 * Retorna o slug do post que esta sendo listado
 * @param boolean $echo
 * @return string
 */

function the_slug_post($echo=true){

    $slug = basename(get_permalink());
    do_action('before_slug', $slug);
    $slug = apply_filters('slug_filter', $slug);
    if( $echo ) echo $slug;
    do_action('after_slug', $slug);
    return $slug;
}

/*SUPPORT IMAGE SIZE BLOCO SIAS*/
    add_image_size('thumb_block_sias', 299, 334, true);

/*ADICIONA SUPORTE RESUMO AO POST TYPE PAGE*/
    add_post_type_support( 'page', 'excerpt' );


/**
 * Thumbnail custom sizes
 */
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'thumb-exemplo', 0, 0, true );
}


/**
 * Função que define o post por page do custom post type depoimentos
 * @param unknown $query
 */
function depoimentos_pre_get_post($query) {
    if( is_post_type_archive('depoimentos') && !is_admin() && $query->is_main_query() ) {
        $query->set('posts_per_page', 6 );
    }
}

/**
 * Hook que dispara o evento que pega o tipo do custom post type e
 * chama a função depoimentos_pre_get_post
 */
add_action('pre_get_posts', 'depoimentos_pre_get_post');

// Remove determinado js aqui no caso jquery //
function my_deregister_javascript() {
    wp_deregister_script( 'jquery' );
}
add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );

/**
 * Adicionar field no config
 */

$new_general_setting = new new_general_setting();

class new_general_setting {
    function new_general_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'favorite_color', 'esc_attr' );
        add_settings_field('fav_color', '<label for="favorite_color">'.__('Habilitar modal' , 'favorite_color' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'favorite_color', '' );
        if($value == 1){
            echo '<input type="checkbox" id="favorite_color" name="favorite_color" checked />';
        }else{
            echo '<input type="checkbox" id="favorite_color" name="favorite_color" value="1" />';
        }
    }
}



