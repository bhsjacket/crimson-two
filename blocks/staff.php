<?php

if( empty( $_GET['academic_year'] ) ) {
    $academicYear = academicYear( new DateTime('now') );
} else {
    $academicYear = $_GET['academic_year'];
}

$years = get_field_object('field_5f0d0052c7616')['choices'];
$years = array_reverse($years);

?>

<div class="staff-block">

<?php if( get_field('display') == 'all_years' ) { ?>

    <select name="year" class="select-academic-year">
        <?php foreach($years as $year) {
            echo '<option value="' . $year . '">' . $year . '</option>';
        } ?>
    </select>

<?php } ?>

<div class="staff-boxes">

<?php

$roles = [
    'editorial',
    'writer',
    'photographer',
    'illustrator'
];

foreach( $roles as $role ) {

    $queryVariable = $role . 'Query';

    $$queryVariable = new WP_User_Query( [
        'meta_key' => 'last_name',
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'staff_page_section',
                'value' => $role
            ],
            [
                'key' => 'jacket_years',
                'value' =>  $academicYear,
                'compare' => 'LIKE'
            ]
        ]
    ] );

    ?>

    <div class="author-boxes staff-boxes <?php echo $role; ?>-boxes">
        <?php foreach( $$queryVariable->results as $author ) { ?>
        <a href="<?php echo get_author_posts_url( $author->ID ); ?>" class="author-box">
            <img src="<?php echo get_avatar_url( $author->ID, [ 'size' => '256' ] ) ?>">
            <div>
                <h2 class="author-box-name"><?php echo $author->display_name; ?></h2>
                <h2 class="author-box-position"><?php echo get_field( 'position', 'user_' . $author->ID ); ?></h2>
            </div>
        </a>
        <?php } ?>
    </div>

<?php } ?>

</div>

</div>