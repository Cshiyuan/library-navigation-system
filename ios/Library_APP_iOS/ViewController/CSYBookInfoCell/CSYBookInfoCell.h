//
//  CSYBookInfoCell.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/9.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface CSYBookInfoCell : UITableViewCell

@property (weak, nonatomic) IBOutlet UIImageView *bKImageView;
@property (weak, nonatomic) IBOutlet UILabel *bKNameLabel;
@property (weak, nonatomic) IBOutlet UILabel *bKPubNameLabel;
@property (weak, nonatomic) IBOutlet UILabel *detailInfoLabel;

@end
