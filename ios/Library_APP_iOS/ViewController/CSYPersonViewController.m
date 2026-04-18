//
//  CSYPersonViewController.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/8.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYPersonViewController.h"

//NSArray *const sectionTitles = @[@"Leave Feedback", @"Follow Us"];
//NSString *const sectionTitles = @"asd";

@interface CSYPersonViewController ()<UITableViewDelegate,UITableViewDataSource>
{
    NSArray *_sectionTitles;
    NSArray *_sectionContent;
    __weak IBOutlet UITableView* _myTableView;
}
@end

@implementation CSYPersonViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    
    _myTableView.delegate = self;
    _myTableView.dataSource = self;
    
    _sectionTitles = @[@"Leave Feedback", @"Follow Us"];
    _sectionContent = @[@[@"Rate us on App Store",@"Tell us your feedback"],@[@"Twitter",@"Facebook",@"Pinterest"]];
    // Do any additional setup after loading the view.
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma -mark 定制statusBar部分
-(UIStatusBarStyle)preferredStatusBarStyle
{
    return UIStatusBarStyleLightContent;
}


#pragma --mark 

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    NSArray *array = _sectionContent[section];
    return array.count;
}


- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return _sectionTitles.count;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section
{
    return _sectionTitles[section];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:@"Cell" forIndexPath:indexPath];
    
    cell.textLabel.text = _sectionContent[indexPath.section][indexPath.row];
    
    return cell;
}
@end
