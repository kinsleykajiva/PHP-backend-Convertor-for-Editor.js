<?php
	$jstring = "{
    \"time\" : 1574505638637,
    \"blocks\" : [
        {
            \"type\" : \"header\",
            \"data\" : {
                \"text\" : \"Editor.js\",
                \"level\" : 2
            }
        },
        {
            \"type\" : \"paragraph\",
            \"data\" : {
                \"text\" : \"Hey. Meet the new Editor. On this page you can see it in action — try to edit this text.\"
            }
        },
        {
            \"type\" : \"header\",
            \"data\" : {
                \"text\" : \"Key features\",
                \"level\" : 3
            }
        },
        {
            \"type\" : \"list\",
            \"data\" : {
                \"style\" : \"unordered\",
                \"items\" : [
                    \"It is a block-styled editor\",
                    \"It returns clean data output in JSON\",
                    \"Designed to be extendable and pluggable with a simple API\"
                ]
            }
        },
        {
            \"type\" : \"header\",
            \"data\" : {
                \"text\" : \"What does it mean «block-styled editor»\",
                \"level\" : 3
            }
        },
        {
            \"type\" : \"header\",
            \"data\" : {
                \"text\" : \"What does it mean clean data output\",
                \"level\" : 3
            }
        },
        {
            \"type\" : \"paragraph\",
            \"data\" : {
                \"text\" : \"Classic WYSIWYG-editors produce raw HTML-markup with both content data and content appearance. On the contrary, Editor.js outputs JSON object with data of each Block. You can see an example below\"
            }
        },
        {
            \"type\" : \"delimiter\",
            \"data\" : {}
        },
        {
            \"type\" : \"image\",
            \"data\" : {
                \"file\" : {
                    \"url\" : \"https://capella.pics/6d8f1a84-9544-4afa-b806-5167d45baf7c.jpg\"
                },
                \"caption\" : \"bvhfghg\",
                \"withBorder\" : true,
                \"stretched\" : false,
                \"withBackground\" : false
            }
        }
    ],
    \"version\" : \"2.15.0\"
}";
	$jstring = json_decode( $jstring );
	function htmConversion ( array $data ): string
	{

		$ret = '';
		foreach ( $data as $item ) {
			//print $item->type;exit;
			switch ( $item->type ) {
				case 'header':
					$levelSize = $item->data->level;
					$levelText = $item->data->text;
					$ret .= "<h{$levelSize}> $levelText </h{$levelSize}> ";
					$ret .= '<br>';
					break;

				case 'paragraph':
					$levelText = $item->data->text;
					$ret .= $levelText;
					break;
				case 'list':
					$levelStyle = $item->data->style === 'unordered' ? 'ul' : 'ol';
					$levelArr = $item->data->items;
					$listItem ="<{$levelStyle}>";
					foreach ($levelArr as $eleItem){
						$listItem .= "<li> $eleItem </li>";
					}
					$listItem ="</{$levelStyle}>";

					$ret .= $listItem;
					$ret .= '<br>';
					break;
				case 'image':
					$levelFilePath = $item->data->file->url;
					$levelCaption = $item->data->caption;

					$ret.= '<div class="image-tool__image-preloader" style="border: 1px solid #000000 ;">
											<img style="max-width: 100%;vertical-align: bottom;display: block;" src="'.$levelFilePath.'">
								</div> 
								<br>
								<center>'.$levelCaption.'</center>
								';
					$ret .= '<br>';
					break;

			}

		}
		return $ret;
	}

	print htmConversion( $jstring->blocks );
	//print_r ($jstring->blocks);
